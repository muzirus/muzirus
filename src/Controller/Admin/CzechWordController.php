<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Events;
use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\CzechWord;
use App\Entity\Translation;
use App\Entity\TranslationExample;
use App\Event\CzechWordEvent;
use App\Event\TranslationEvent;
use App\Event\TranslationExampleEvent;
use App\Facade\CzechWordFacade;
use App\Facade\TranslationExampleFacade;
use App\Facade\TranslationFacade;
use App\Form\Translation\CreateCzechWordTranslationForm;
use App\Form\Translation\TranslationFormData;
use App\Form\Translation\UpdateTranslationForm;
use App\Form\TranslationExample\TranslationExampleForm;
use App\Form\TranslationExample\TranslationExampleFormData;
use App\Form\Word\CzechWordForm;
use App\Form\Word\CzechWordFormData;
use App\Repository\CzechWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/czech-word")
 */
class CzechWordController extends AbstractController
{
    /**
     * @Route("", name="admin.czech-word")
     * @Method("GET")
     */
    public function index(CzechWordRepository $czechWordRepository): Response
    {
        return $this->render(
            'admin/czech-word/index.html.twig',
            [
                'words' => $czechWordRepository->findAllOptimizedForAdminWordList(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.czech-word.add")
     * @Method({"GET", "POST"})
     */
    public function add(
        Request $request,
        CzechWordFacade $czechWordFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = new CzechWordFormData();

        $form = $this->createForm(CzechWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $word = $czechWordFacade->createWord($formData);

            $dispatcher->dispatch(
                Events::CZECH_WORD_CREATED,
                new CzechWordEvent($this->getUser(), $word)
            );

            $this->addFlashSuccess(Flashes::WORD_CREATED);

            return $this->redirectToRoute('admin.czech-word.edit', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/czech-word/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.czech-word.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(
        Request $request,
        CzechWord $word,
        CzechWordFacade $czechWordFacade,
        CzechWordRepository $czechWordRepository,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = CzechWordFormData::createFromWord($word);

        $form = $this->createForm(CzechWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $czechWordFacade->updateWord($word, $formData);

            $dispatcher->dispatch(
                Events::CZECH_WORD_UPDATED,
                new CzechWordEvent($this->getUser(), $word)
            );

            $this->addFlashSuccess(Flashes::WORD_UPDATED);

            return $this->redirectToRoute('admin.czech-word.edit', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/czech-word/edit.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'wordNext' => $czechWordRepository->findOneNext($word),
                'wordPrev' => $czechWordRepository->findOnePrev($word),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.czech-word.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(CzechWord $word, CzechWordFacade $czechWordFacade): RedirectResponse
    {
        $czechWordFacade->deleteWord($word);

        $this->addFlashSuccess(Flashes::WORD_DELETED);

        return $this->redirectToRoute('admin.czech-word');
    }

    /**
     * @Route("/{id}/translations", name="admin.czech-word.translations", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function translations(
        Request $request,
        CzechWord $word,
        TranslationFacade $translationFacade,
        CzechWordRepository $czechWordRepository,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = TranslationFormData::createFromCzechWord($word);

        $form = $this->createForm(CreateCzechWordTranslationForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translation = $translationFacade->createTranslation($formData);

            $dispatcher->dispatch(
                Events::TRANSLATION_CREATED,
                new TranslationEvent($this->getUser(), $translation)
            );

            $this->addFlashSuccess(Flashes::TRANSLATION_CREATED);

            return $this->redirectToRoute('admin.czech-word.translations', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/czech-word/translations/index.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'wordNext' => $czechWordRepository->findOneNext($word),
                'wordPrev' => $czechWordRepository->findOnePrev($word),
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/edit",
     *     name="admin.czech-word.translations.edit",
     *     requirements={"id": "\d+", "translationId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method({"GET", "POST"})
     */
    public function translationsEdit(
        Request $request,
        CzechWord $word,
        Translation $translation,
        TranslationFacade $translationFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = TranslationFormData::createFromTranslation($translation);

        $form = $this->createForm(UpdateTranslationForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationFacade->updateTranslation($translation, $formData);

            $dispatcher->dispatch(
                Events::TRANSLATION_UPDATED,
                new TranslationEvent($this->getUser(), $translation)
            );

            $this->addFlashSuccess(Flashes::TRANSLATION_UPDATED);

            return $this->redirectToRoute(
                'admin.czech-word.translations.edit',
                [
                    'id' => $translation->getCzechWord()->getId(),
                    'translationId' => $translation->getId(),
                ]
            );
        }

        return $this->render(
            'admin/czech-word/translations/edit.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'translation' => $translation,
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/remove",
     *     name="admin.czech-word.translations.remove",
     *     requirements={"id": "\d+", "translationId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method("POST")
     */
    public function translationsRemove(
        CzechWord $word,
        Translation $translation,
        TranslationFacade $translationFacade
    ): RedirectResponse {
        // todo: check that translation belongs to that word

        $translationFacade->deleteTranslation($translation);

        $this->addFlashSuccess(Flashes::TRANSLATION_DELETED);

        return $this->redirectToRoute('admin.czech-word.translations', ['id' => $word->getId()]);
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/position/up",
     *     name="admin.czech-word.translations.position.up",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     defaults={"position": "up"}
     * )
     * @Route(
     *     "/{id}/translations/{translationId}/position/down",
     *     name="admin.czech-word.translations.position.down",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     defaults={"position": "down"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method({"GET"})
     */
    public function translationsPosition(
        CzechWord $word,
        Translation $translation,
        TranslationFacade $translationFacade,
        string $position
    ): RedirectResponse {
        // todo: check that translation belongs to that word

        $translationFacade->updateTranslationPositionInCzechWordDetail($translation, $position);

        $this->addFlashSuccess(Flashes::TRANSLATION_UPDATED);

        return $this->redirectToRoute(
            'admin.czech-word.translations',
            [
                'id' => $word->getId(),
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/examples",
     *     name="admin.czech-word.translations.examples",
     *     requirements={"id": "\d+", "translationId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method({"GET", "POST"})
     */
    public function translationExamples(
        Request $request,
        CzechWord $word,
        Translation $translation,
        TranslationExampleFacade $translationExampleFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = new TranslationExampleFormData($translation);
        $form = $this->createForm(TranslationExampleForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationExample = $translationExampleFacade->createTranslationExample($formData);

            $dispatcher->dispatch(
                Events::TRANSLATION_EXAMPLE_CREATED,
                new TranslationExampleEvent($this->getUser(), $translationExample)
            );

            $this->addFlashSuccess(Flashes::TRANSLATION_EXAMPLE_CREATED);

            return $this->redirectToRoute(
                'admin.czech-word.translations.examples',
                [
                    'id' => $word->getId(),
                    'translationId' => $translation->getId(),
                ]
            );
        }

        return $this->render(
            'admin/czech-word/translations/examples/index.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'translation' => $translation,
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/examples/{translationExampleId}/edit",
     *     name="admin.czech-word.translations.examples.edit",
     *     requirements={"id": "\d+", "translationId": "\d+", "translationExampleId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @ParamConverter("translationExample", options={"id": "translationExampleId"})
     * @Method({"GET", "POST"})
     */
    public function translationExamplesEdit(
        Request $request,
        CzechWord $word,
        Translation $translation,
        TranslationExample $translationExample,
        TranslationExampleFacade $translationExampleFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = TranslationExampleFormData::fromTranslationExample($translationExample);

        $form = $this->createForm(TranslationExampleForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationExampleFacade->updateTranslationExample($translationExample, $formData);

            $dispatcher->dispatch(
                Events::TRANSLATION_EXAMPLE_UPDATED,
                new TranslationExampleEvent($this->getUser(), $translationExample)
            );

            $this->addFlashSuccess(Flashes::TRANSLATION_EXAMPLE_UPDATED);

            return $this->redirectToRoute(
                'admin.czech-word.translations.examples.edit',
                [
                    'id' => $word->getId(),
                    'translationId' => $translation->getId(),
                    'translationExampleId' => $translationExample->getId(),
                ]
            );
        }

        return $this->render(
            'admin/czech-word/translations/examples/edit.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'translation' => $translation,
                'translationExample' => $translationExample,
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/examples/{translationExampleId}/remove",
     *     name="admin.czech-word.translations.examples.remove",
     *     requirements={"id": "\d+", "translationId": "\d+", "translationExampleId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @ParamConverter("translationExample", options={"id": "translationExampleId"})
     * @Method("POST")
     */
    public function translationExamplesRemove(
        CzechWord $word,
        Translation $translation,
        TranslationExample $translationExample,
        TranslationExampleFacade $translationExampleFacade
    ): RedirectResponse {
        // todo: check that translation example belongs to that word and that translation

        $translationExampleFacade->deleteTranslationExample($translationExample);

        $this->addFlashSuccess(Flashes::TRANSLATION_EXAMPLE_DELETED);

        return $this->redirectToRoute(
            'admin.czech-word.translations.examples',
            [
                'id' => $word->getId(),
                'translationId' => $translation->getId(),
            ]
        );
    }
}

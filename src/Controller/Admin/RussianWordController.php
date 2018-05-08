<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Events;
use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\RussianWord;
use App\Entity\Translation;
use App\Entity\TranslationExample;
use App\Event\RussianWordEvent;
use App\Event\TranslationEvent;
use App\Event\TranslationExampleEvent;
use App\Facade\RussianWordFacade;
use App\Facade\TranslationExampleFacade;
use App\Facade\TranslationFacade;
use App\Form\Translation\CreateRussianWordTranslationForm;
use App\Form\Translation\TranslationFormData;
use App\Form\Translation\UpdateTranslationForm;
use App\Form\TranslationExample\TranslationExampleForm;
use App\Form\TranslationExample\TranslationExampleFormData;
use App\Form\Word\RussianWordForm;
use App\Form\Word\RussianWordFormData;
use App\Repository\RussianWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/russian-word")
 */
class RussianWordController extends AbstractController
{
    /**
     * @Route("", name="admin.russian-word")
     * @Method("GET")
     */
    public function index(RussianWordRepository $russianWordRepository): Response
    {
        return $this->render(
            'admin/russian-word/index.html.twig',
            [
                'words' => $russianWordRepository->findAllOptimizedForAdminWordList(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.russian-word.add")
     * @Method({"GET", "POST"})
     */
    public function add(
        Request $request,
        RussianWordFacade $russianWordFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = new RussianWordFormData();

        $form = $this->createForm(RussianWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $word = $russianWordFacade->createWord($formData);

            $dispatcher->dispatch(
                Events::RUSSIAN_WORD_CREATED,
                new RussianWordEvent($this->getUser(), $word)
            );

            $this->addFlashSuccess(Flashes::WORD_CREATED);

            return $this->redirectToRoute('admin.russian-word.edit', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/russian-word/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.russian-word.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(
        Request $request,
        RussianWord $word,
        RussianWordFacade $russianWordFacade,
        RussianWordRepository $russianWordRepository,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = RussianWordFormData::createFromWord($word);

        $form = $this->createForm(RussianWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $russianWordFacade->updateWord($word, $formData);

            $dispatcher->dispatch(
                Events::RUSSIAN_WORD_UPDATED,
                new RussianWordEvent($this->getUser(), $word)
            );

            $this->addFlashSuccess(Flashes::WORD_UPDATED);

            return $this->redirectToRoute('admin.russian-word.edit', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/russian-word/edit.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'wordNext' => $russianWordRepository->findOneNext($word),
                'wordPrev' => $russianWordRepository->findOnePrev($word),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.russian-word.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(RussianWord $word, RussianWordFacade $russianWordFacade): RedirectResponse
    {
        $russianWordFacade->deleteWord($word);

        $this->addFlashSuccess('admin.word.deleted');

        return $this->redirectToRoute(Flashes::WORD_DELETED);
    }

    /**
     * @Route("/{id}/translations", name="admin.russian-word.translations", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function translations(
        Request $request,
        RussianWord $word,
        TranslationFacade $translationFacade,
        RussianWordRepository $russianWordRepository,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = TranslationFormData::createFromRussianWord($word);

        $form = $this->createForm(CreateRussianWordTranslationForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translation = $translationFacade->createTranslation($formData);

            $dispatcher->dispatch(
                Events::TRANSLATION_CREATED,
                new TranslationEvent($this->getUser(), $translation)
            );

            $this->addFlashSuccess(Flashes::TRANSLATION_CREATED);

            return $this->redirectToRoute('admin.russian-word.translations', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/russian-word/translations/index.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'wordNext' => $russianWordRepository->findOneNext($word),
                'wordPrev' => $russianWordRepository->findOnePrev($word),
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/edit",
     *     name="admin.russian-word.translations.edit",
     *     requirements={"id": "\d+", "translationId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method({"GET", "POST"})
     */
    public function translationsEdit(
        Request $request,
        RussianWord $word,
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
                'admin.russian-word.translations.edit',
                [
                    'id' => $translation->getRussianWord()->getId(),
                    'translationId' => $translation->getId(),
                ]
            );
        }

        return $this->render(
            'admin/russian-word/translations/edit.html.twig',
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
     *     name="admin.russian-word.translations.remove",
     *     requirements={"id": "\d+", "translationId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method("POST")
     */
    public function translationsRemove(
        RussianWord $word,
        Translation $translation,
        TranslationFacade $translationFacade
    ): RedirectResponse {
        // todo: check that translation belongs to that word

        $translationFacade->deleteTranslation($translation);

        $this->addFlashSuccess(Flashes::TRANSLATION_DELETED);

        return $this->redirectToRoute('admin.russian-word.translations', ['id' => $word->getId()]);
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/position/up",
     *     name="admin.russian-word.translations.position.up",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     defaults={"position": "up"}
     * )
     * @Route(
     *     "/{id}/translations/{translationId}/position/down",
     *     name="admin.russian-word.translations.position.down",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     defaults={"position": "down"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method({"GET"})
     */
    public function translationsPosition(
        RussianWord $word,
        Translation $translation,
        TranslationFacade $translationFacade,
        string $position
    ): RedirectResponse {
        // todo: check that translation belongs to that word

        $translationFacade->updateTranslationPositionInRussianWordDetail($translation, $position);

        $this->addFlashSuccess(Flashes::TRANSLATION_UPDATED);

        return $this->redirectToRoute(
            'admin.russian-word.translations',
            [
                'id' => $word->getId(),
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/examples",
     *     name="admin.russian-word.translations.examples",
     *     requirements={"id": "\d+", "translationId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method({"GET", "POST"})
     */
    public function translationExamples(
        Request $request,
        RussianWord $word,
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
                'admin.russian-word.translations.examples',
                [
                    'id' => $word->getId(),
                    'translationId' => $translation->getId(),
                ]
            );
        }

        return $this->render(
            'admin/russian-word/translations/examples/index.html.twig',
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
     *     name="admin.russian-word.translations.examples.edit",
     *     requirements={"id": "\d+", "translationId": "\d+", "translationExampleId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @ParamConverter("translationExample", options={"id": "translationExampleId"})
     * @Method({"GET", "POST"})
     */
    public function translationExamplesEdit(
        Request $request,
        RussianWord $word,
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
                'admin.russian-word.translations.examples.edit',
                [
                    'id' => $word->getId(),
                    'translationId' => $translation->getId(),
                    'translationExampleId' => $translationExample->getId(),
                ]
            );
        }

        return $this->render(
            'admin/russian-word/translations/examples/edit.html.twig',
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
     *     name="admin.russian-word.translations.examples.remove",
     *     requirements={"id": "\d+", "translationId": "\d+", "translationExampleId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @ParamConverter("translationExample", options={"id": "translationExampleId"})
     * @Method("POST")
     */
    public function translationExamplesRemove(
        RussianWord $word,
        Translation $translation,
        TranslationExample $translationExample,
        TranslationExampleFacade $translationExampleFacade
    ): RedirectResponse {
        // todo: check that translation example belongs to that word and that translation

        $translationExampleFacade->deleteTranslationExample($translationExample);

        $this->addFlashSuccess(Flashes::TRANSLATION_EXAMPLE_DELETED);

        return $this->redirectToRoute(
            'admin.russian-word.translations.examples',
            [
                'id' => $word->getId(),
                'translationId' => $translation->getId(),
            ]
        );
    }
}

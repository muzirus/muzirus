<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\CzechWord;
use App\Entity\Translation;
use App\Entity\TranslationExample;
use App\Facade\CzechWordFacade;
use App\Facade\TranslationExampleFacade;
use App\Facade\TranslationFacade;
use App\Form\Translation\CreateRussianTranslationForm;
use App\Form\Translation\CreateRussianTranslationFormData;
use App\Form\Translation\UpdateTranslationForm;
use App\Form\Translation\UpdateTranslationFormData;
use App\Form\TranslationExample\TranslationExampleForm;
use App\Form\TranslationExample\TranslationExampleFormData;
use App\Form\Word\CzechWordForm;
use App\Form\Word\CzechWordFormData;
use App\Repository\CzechWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
                'words' => $czechWordRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.czech-word.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request, CzechWordFacade $czechWordFacade): Response
    {
        $formData = new CzechWordFormData();

        $form = $this->createForm(CzechWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $word = $czechWordFacade->createWord($formData);

            $this->addFlashSuccess('czech-word.created_successfully');

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
        CzechWordRepository $czechWordRepository
    ): Response {
        $formData = CzechWordFormData::createFromWord($word);

        $form = $this->createForm(CzechWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $czechWordFacade->updateWord($word, $formData);

            $this->addFlashSuccess('czech-word.updated_successfully');

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

        $this->addFlashSuccess('czech-word.deleted_successfully');

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
        CzechWordRepository $czechWordRepository
    ): Response {
        $formData = new CreateRussianTranslationFormData($word);
        $form = $this->createForm(CreateRussianTranslationForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationFacade->createTranslation($formData);

            $this->addFlashSuccess('translation.created_successfully');

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
        TranslationFacade $translationFacade
    ): Response {
        $formData = UpdateTranslationFormData::fromTranslation($translation);

        $form = $this->createForm(UpdateTranslationForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationFacade->updateTranslation($translation, $formData);

            $this->addFlashSuccess('translation.updated_successfully');

            return $this->redirectToRoute(
                'admin.czech-word.translations.edit',
                [
                    'id' => $word->getId(),
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

        $this->addFlashSuccess('translation.deleted_successfully');

        return $this->redirectToRoute('admin.czech-word.translations', ['id' => $word->getId()]);
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
        TranslationExampleFacade $translationExampleFacade
    ): Response {
        $formData = new TranslationExampleFormData($translation);
        $form = $this->createForm(TranslationExampleForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationExampleFacade->createTranslationExample($formData);

            $this->addFlashSuccess('translation_example.created_successfully');

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
        TranslationExampleFacade $translationExampleFacade
    ): Response {
        $formData = TranslationExampleFormData::fromTranslationExample($translationExample);

        $form = $this->createForm(TranslationExampleForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationExampleFacade->updateTranslationExample($translationExample, $formData);

            $this->addFlashSuccess('translation_example.updated_successfully');

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

        $this->addFlashSuccess('translation_example.deleted_successfully');

        return $this->redirectToRoute(
            'admin.czech-word.translations.examples',
            [
                'id' => $word->getId(),
                'translationId' => $translation->getId(),
            ]
        );
    }
}

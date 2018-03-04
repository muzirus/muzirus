<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\RussianWord;
use App\Entity\Translation;
use App\Facade\RussianWordFacade;
use App\Facade\TranslationFacade;
use App\Form\Translation\CreateCzechTranslationForm;
use App\Form\Translation\CreateCzechTranslationFormData;
use App\Form\Translation\UpdateTranslationForm;
use App\Form\Translation\UpdateTranslationFormData;
use App\Form\Word\RussianWordForm;
use App\Form\Word\RussianWordFormData;
use App\Repository\RussianWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
                'words' => $russianWordRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.russian-word.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request, RussianWordFacade $russianWordFacade): Response
    {
        $formData = new RussianWordFormData();

        $form = $this->createForm(RussianWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $russianWordFacade->createWord($formData);

            $this->addFlashSuccess('russian-word.created_successfully');

            return $this->redirectToRoute('admin.russian-word');
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
        RussianWordRepository $russianWordRepository
    ): Response {
        $formData = RussianWordFormData::createFromWord($word);

        $form = $this->createForm(RussianWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $russianWordFacade->updateWord($word, $formData);

            $this->addFlashSuccess('russian-word.updated_successfully');

            return $this->redirectToRoute('admin.russian-word');
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

        $this->addFlashSuccess('russian-word.deleted_successfully');

        return $this->redirectToRoute('admin.russian-word');
    }

    /**
     * @Route("/{id}/translations", name="admin.russian-word.translations", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function translations(
        Request $request,
        RussianWord $word,
        TranslationFacade $translationFacade,
        RussianWordRepository $russianWordRepository
    ): Response {
        $formData = new CreateCzechTranslationFormData($word);
        $form = $this->createForm(CreateCzechTranslationForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationFacade->createTranslation($formData);

            $this->addFlashSuccess('translation.created_successfully');

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
     * @ParamConverter("translation", options={"id" = "translationId"})
     * @Method({"GET", "POST"})
     */
    public function translationsEdit(
        Request $request,
        RussianWord $word,
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
                'admin.russian-word.translations',
                [
                    'id' => $word->getId(),
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
     * @ParamConverter("translation", options={"id" = "translationId"})
     * @Method("POST")
     */
    public function translationsRemove(
        RussianWord $word,
        Translation $translation,
        TranslationFacade $translationFacade
    ): RedirectResponse {
        // todo: check that translation belongs to that word

        $translationFacade->deleteTranslation($translation);

        $this->addFlashSuccess('translation.deleted_successfully');

        return $this->redirectToRoute('admin.russian-word.translations', ['id' => $word->getId()]);
    }
}

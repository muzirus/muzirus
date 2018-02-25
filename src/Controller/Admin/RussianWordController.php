<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\RussianWord;
use App\Facade\RussianWordFacade;
use App\Form\Word\RussianWordForm;
use App\Form\Word\RussianWordFormData;
use App\Repository\RussianWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @var RussianWordFacade
     */
    private $russianWordFacade;

    /**
     * @var RussianWordRepository
     */
    private $russianWordRepository;

    public function __construct(RussianWordFacade $russianWordFacade, RussianWordRepository $russianWordRepository)
    {
        $this->russianWordFacade = $russianWordFacade;
        $this->russianWordRepository = $russianWordRepository;
    }

    /**
     * @Route("", name="admin.russian-word")
     * @Method("GET")
     */
    public function index(): Response
    {
        return $this->render(
            'admin/russian-word/index.html.twig',
            [
                'words' => $this->russianWordRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.russian-word.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $formData = new RussianWordFormData();

        $form = $this->createForm(RussianWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->russianWordFacade->createWord($formData);

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
     * @Route("/{id}", name="admin.russian-word.view", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function view(RussianWord $word): Response
    {
        return $this->render(
            'admin/russian-word/view.html.twig',
            [
                'word' => $word,
            ]
        );
    }

    /**
     * @Route("/{id}/translations", name="admin.russian-word.view-translations", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function viewTranslations(RussianWord $word): Response
    {
        return $this->render(
            'admin/russian-word/view-translations.html.twig',
            [
                'word' => $word,
                'wordNext' => $this->russianWordRepository->findOneNext($word),
                'wordPrev' => $this->russianWordRepository->findOnePrev($word),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.russian-word.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, RussianWord $word): Response
    {
        $formData = RussianWordFormData::createFromWord($word);

        $form = $this->createForm(RussianWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->russianWordFacade->updateWord($word, $formData);

            $this->addFlashSuccess('russian-word.updated_successfully');

            return $this->redirectToRoute('admin.russian-word');
        }

        return $this->render(
            'admin/russian-word/edit.html.twig',
            [
                'word' => $word,
                'wordNext' => $this->russianWordRepository->findOneNext($word),
                'wordPrev' => $this->russianWordRepository->findOnePrev($word),
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.russian-word.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(RussianWord $word): RedirectResponse
    {
        $this->russianWordFacade->deleteWord($word);

        $this->addFlashSuccess('russian-word.deleted_successfully');

        return $this->redirectToRoute('admin.russian-word');
    }
}

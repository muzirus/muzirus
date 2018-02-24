<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\RussianWord;
use App\Facade\RussianWordFacade;
use App\Form\Word\RussianWordForm;
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

    public function __construct(RussianWordFacade $russianWordFacade)
    {
        $this->russianWordFacade = $russianWordFacade;
    }

    /**
     * @Route("", name="admin.russian-word")
     * @Method("GET")
     */
    public function index(RussianWordRepository $russianWordRepository): Response
    {
        return $this->render(
            'admin/russian-word/index.html.twig',
            [
                'russianWords' => $russianWordRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.russian-word.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $form = $this->createForm(RussianWordForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->russianWordFacade->createWord($form->getData());

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
    public function view(RussianWord $russianWord): Response
    {
        return $this->render(
            'admin/russian-word/view.html.twig',
            [
                'russianWord' => $russianWord,
            ]
        );
    }

    /**
     * @Route("/{id}/translations", name="admin.russian-word.view-translations", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function viewTranslations(RussianWord $russianWord): Response
    {
        return $this->render(
            'admin/russian-word/view-translations.html.twig',
            [
                'russianWord' => $russianWord,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.russian-word.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(RussianWord $russianWord): Response
    {
        $form = $this->createForm(RussianWordForm::class);

        // todo

        return $this->render(
            'admin/russian-word/edit.html.twig',
            [
                'russianWord' => $russianWord,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.russian-word.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(RussianWord $russianWord): RedirectResponse
    {
        $this->russianWordFacade->deleteWord($russianWord);

        $this->addFlashSuccess('russian-word.deleted_successfully');

        return $this->redirectToRoute('admin.russian-word');
    }
}

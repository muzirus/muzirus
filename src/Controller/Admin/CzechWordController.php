<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\CzechWord;
use App\Facade\CzechWordFacade;
use App\Form\Word\CzechWordForm;
use App\Repository\CzechWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @var CzechWordFacade
     */
    private $czechWordFacade;

    public function __construct(CzechWordFacade $czechWordFacade)
    {
        $this->czechWordFacade = $czechWordFacade;
    }

    /**
     * @Route("", name="admin.czech-word")
     * @Method("GET")
     */
    public function index(CzechWordRepository $czechWordRepository): Response
    {
        return $this->render(
            'admin/czech-word/index.html.twig',
            [
                'czechWords' => $czechWordRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.czech-word.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $form = $this->createForm(CzechWordForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->czechWordFacade->createWord($form->getData());

            $this->addFlashSuccess('czech-word.created_successfully');

            return $this->redirectToRoute('admin.czech-word');
        }

        return $this->render(
            'admin/czech-word/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="admin.czech-word.view", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function view(CzechWord $czechWord): Response
    {
        return $this->render(
            'admin/czech-word/view.html.twig',
            [
                'czechWord' => $czechWord,
            ]
        );
    }

    /**
     * @Route("/{id}/translations", name="admin.czech-word.view-translations", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function viewTranslations(CzechWord $czechWord): Response
    {
        return $this->render(
            'admin/czech-word/view-translations.html.twig',
            [
                'czechWord' => $czechWord,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.czech-word.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(CzechWord $czechWord): Response
    {
        $form = $this->createForm(CzechWordForm::class);

        // todo

        return $this->render(
            'admin/czech-word/edit.html.twig',
            [
                'czechWord' => $czechWord,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.czech-word.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(CzechWord $czechWord): RedirectResponse
    {
        $this->czechWordFacade->deleteWord($czechWord);

        $this->addFlashSuccess('czech-word.deleted_successfully');

        return $this->redirectToRoute('admin.czech-word');
    }
}

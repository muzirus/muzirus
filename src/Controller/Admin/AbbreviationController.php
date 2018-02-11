<?php

namespace App\Controller\Admin;

use App\Entity\Abbreviation;
use App\Form\AbbreviationType;
use App\Repository\AbbreviationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/abbreviation")
 */
class AbbreviationController extends AbstractController
{
    /**
     * @Route("", name="admin.abbreviation")
     * @Method("GET")
     */
    public function index(AbbreviationRepository $abbreviationRepository): Response
    {
        return $this->render(
            'admin/abbreviation/index.html.twig',
            [
                'abbreviations' => $abbreviationRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.abbreviation.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $form = $this->createForm(AbbreviationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // todo: save abbreviations

            $this->addFlash('success', 'abbreviation.created_successfully');

            return $this->redirectToRoute('admin.abbreviation');
        }

        return $this->render(
            'admin/abbreviation/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="admin.abbreviation.view", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function view(Abbreviation $abbreviation): Response
    {
        return $this->render(
            'admin/abbreviation/view.html.twig',
            [
                'abbreviation' => $abbreviation,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.abbreviation.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Abbreviation $abbreviation): Response
    {
        return $this->render(
            'admin/abbreviation/edit.html.twig',
            [
                'abbreviation' => $abbreviation,
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.abbreviation.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(Abbreviation $abbreviation): RedirectResponse
    {
        // todo

        $this->addFlash('success', 'abbreviation.deleted_successfully');

        return $this->redirectToRoute('admin.abbreviation');
    }
}

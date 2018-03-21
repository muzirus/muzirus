<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Abbreviation;
use App\Facade\AbbreviationFacade;
use App\Form\Abbreviation\AbbreviationForm;
use App\Form\Abbreviation\AbbreviationFormData;
use App\Repository\AbbreviationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
    public function add(Request $request, AbbreviationFacade $abbreviationFacade): Response
    {
        $abbreviationFormData = new AbbreviationFormData();

        $form = $this->createForm(AbbreviationForm::class, $abbreviationFormData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abbreviationFacade->createAbbreviation($abbreviationFormData);

            $this->addFlashSuccess('abbreviation.created_successfully');

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
     * @Route("/{id}/edit", name="admin.abbreviation.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Abbreviation $abbreviation, AbbreviationFacade $abbreviationFacade): Response
    {
        $abbreviationFormData = AbbreviationFormData::fromAbbreviation($abbreviation);

        $form = $this->createForm(AbbreviationForm::class, $abbreviationFormData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abbreviationFacade->updateAbbreviation($abbreviation, $abbreviationFormData);

            $this->addFlashSuccess('abbreviation.updated_successfully');

            return $this->redirectToRoute('admin.abbreviation');
        }

        return $this->render(
            'admin/abbreviation/edit.html.twig',
            [
                'abbreviation' => $abbreviation,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.abbreviation.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(Abbreviation $abbreviation, AbbreviationFacade $abbreviationFacade): RedirectResponse
    {
        $abbreviationFacade->deleteAbbreviation($abbreviation);

        $this->addFlashSuccess('abbreviation.deleted_successfully');

        return $this->redirectToRoute('admin.abbreviation');
    }
}

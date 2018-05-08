<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\Abbreviation;
use App\Facade\AbbreviationFacade;
use App\Form\Abbreviation\AbbreviationForm;
use App\Form\Abbreviation\AbbreviationFormData;
use App\Repository\AbbreviationRepository;
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
     * @Route("", methods={"GET"}, name="admin.abbreviation")
     */
    public function index(AbbreviationRepository $abbreviationRepository): Response
    {
        return $this->render(
            'admin/abbreviation/index.html.twig',
            [
                'abbreviations' => $abbreviationRepository->findAllInAscendingOrder(),
            ]
        );
    }

    /**
     * @Route("/add", methods={"GET", "POST"}, name="admin.abbreviation.add")
     */
    public function add(Request $request, AbbreviationFacade $abbreviationFacade): Response
    {
        $abbreviationFormData = new AbbreviationFormData();

        $form = $this->createForm(AbbreviationForm::class, $abbreviationFormData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abbreviationFacade->createAbbreviation($abbreviationFormData);

            $this->addFlashSuccess(Flashes::ABBREVIATION_CREATED);

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
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.abbreviation.edit")
     */
    public function edit(Request $request, Abbreviation $abbreviation, AbbreviationFacade $abbreviationFacade): Response
    {
        $abbreviationFormData = AbbreviationFormData::fromAbbreviation($abbreviation);

        $form = $this->createForm(AbbreviationForm::class, $abbreviationFormData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abbreviationFacade->updateAbbreviation($abbreviation, $abbreviationFormData);

            $this->addFlashSuccess(Flashes::ABBREVIATION_UPDATED);

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
     * @Route("/{id}/remove", methods={"POST"}, requirements={"id": "\d+"}, name="admin.abbreviation.remove")
     */
    public function remove(Abbreviation $abbreviation, AbbreviationFacade $abbreviationFacade): RedirectResponse
    {
        $abbreviationFacade->deleteAbbreviation($abbreviation);

        $this->addFlashSuccess(Flashes::ABBREVIATION_DELETED);

        return $this->redirectToRoute('admin.abbreviation');
    }
}

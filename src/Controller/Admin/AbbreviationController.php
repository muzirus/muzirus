<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Abbreviation;
use App\Facade\AbbreviationFacade;
use App\Form\Abbreviation\AbbreviationForm;
use App\Form\Abbreviation\AbbreviationFormData;
use App\Repository\AbbreviationRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

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
    public function add(
        Request $request,
        AbbreviationFacade $abbreviationFacade,
        TranslatorInterface $translator
    ): Response {
        $abbreviationFormData = new AbbreviationFormData();

        $form = $this->createForm(AbbreviationForm::class, $abbreviationFormData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abbreviationFacade->createAbbreviation($abbreviationFormData);

            $this->addFlashSuccess($translator->trans('admin.abbreviation.created', [], 'flashes'));

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
    public function edit(
        Request $request,
        Abbreviation $abbreviation,
        AbbreviationFacade $abbreviationFacade,
        TranslatorInterface $translator
    ): Response {
        $abbreviationFormData = AbbreviationFormData::fromAbbreviation($abbreviation);

        $form = $this->createForm(AbbreviationForm::class, $abbreviationFormData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $abbreviationFacade->updateAbbreviation($abbreviation, $abbreviationFormData);

            $this->addFlashSuccess($translator->trans('admin.abbreviation.updated', [], 'flashes'));

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
    public function remove(
        Abbreviation $abbreviation,
        AbbreviationFacade $abbreviationFacade,
        TranslatorInterface $translator
    ): RedirectResponse {
        $abbreviationFacade->deleteAbbreviation($abbreviation);

        $this->addFlashSuccess($translator->trans('admin.abbreviation.deleted', [], 'flashes'));

        return $this->redirectToRoute('admin.abbreviation');
    }
}

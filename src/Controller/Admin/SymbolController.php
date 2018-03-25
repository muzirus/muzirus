<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Symbol;
use App\Facade\SymbolFacade;
use App\Form\Symbol\SymbolForm;
use App\Form\Symbol\SymbolFormData;
use App\Repository\SymbolRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/symbol")
 */
class SymbolController extends AbstractController
{
    /**
     * @Route("", name="admin.symbol")
     * @Method("GET")
     */
    public function index(SymbolRepository $symbolRepository): Response
    {
        return $this->render(
            'admin/symbol/index.html.twig',
            [
                'symbols' => $symbolRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.symbol.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request, SymbolFacade $symbolFacade): Response
    {
        $formData = new SymbolFormData();

        $form = $this->createForm(SymbolForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $symbolFacade->createSymbol($formData);

            $this->addFlashSuccess('admin.symbol.created');

            return $this->redirectToRoute('admin.symbol');
        }

        return $this->render(
            'admin/symbol/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.symbol.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, Symbol $symbol, SymbolFacade $symbolFacade): Response
    {
        $formData = SymbolFormData::createFromSymbol($symbol);

        $form = $this->createForm(SymbolForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $symbolFacade->updateSymbol($symbol, $formData);

            $this->addFlashSuccess('admin.symbol.updated');

            return $this->redirectToRoute('admin.symbol');
        }

        return $this->render(
            'admin/symbol/edit.html.twig',
            [
                'symbol' => $symbol,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.symbol.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(Symbol $symbol, SymbolFacade $symbolFacade): RedirectResponse
    {
        $symbolFacade->deleteSymbol($symbol);

        $this->addFlashSuccess('admin.symbol.deleted');

        return $this->redirectToRoute('admin.symbol');
    }
}

<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Symbol;
use App\Facade\SymbolFacade;
use App\Form\Symbol\SymbolForm;
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
     * @var SymbolFacade
     */
    private $symbolFacade;

    public function __construct(SymbolFacade $symbolFacade)
    {
        $this->symbolFacade = $symbolFacade;
    }

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
    public function add(Request $request): Response
    {
        $form = $this->createForm(SymbolForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->symbolFacade->createSymbol($form->getData());

            $this->addFlashSuccess('symbol.created_successfully');

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
     * @Route("/{id}", name="admin.symbol.view", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function view(Symbol $symbol): Response
    {
        return $this->render(
            'admin/symbol/view.html.twig',
            [
                'symbol' => $symbol,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.symbol.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Symbol $symbol): Response
    {
        // todo

        return $this->render(
            'admin/symbol/edit.html.twig',
            [
                'symbol' => $symbol,
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.symbol.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(Symbol $symbol): RedirectResponse
    {
        $this->symbolFacade->deleteSymbol($symbol);

        $this->addFlashSuccess('symbol.deleted_successfully');

        return $this->redirectToRoute('admin.symbol');
    }
}

<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\Symbol;
use App\Facade\SymbolFacade;
use App\Form\Symbol\SymbolForm;
use App\Form\Symbol\SymbolFormData;
use App\Repository\SymbolRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/symbol")
 */
class SymbolController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.symbol")
     */
    public function index(SymbolRepository $symbolRepository): Response
    {
        return $this->render(
            'admin/symbol/index.html.twig',
            [
                'symbols' => $symbolRepository->findAllInAscendingOrder(),
            ]
        );
    }

    /**
     * @Route("/add", methods={"GET", "POST"}, name="admin.symbol.add")
     */
    public function add(Request $request, SymbolFacade $symbolFacade): Response
    {
        $formData = new SymbolFormData();

        $form = $this->createForm(SymbolForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $symbolFacade->createSymbol($formData);

            $this->addFlashSuccess(Flashes::SYMBOL_CREATED);

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
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.symbol.edit")
     */
    public function edit(Request $request, Symbol $symbol, SymbolFacade $symbolFacade): Response
    {
        $formData = SymbolFormData::createFromSymbol($symbol);

        $form = $this->createForm(SymbolForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $symbolFacade->updateSymbol($symbol, $formData);

            $this->addFlashSuccess(Flashes::SYMBOL_UPDATED);

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
     * @Route("/{id}/remove", requirements={"id": "\d+"}, methods={"POST"}, name="admin.symbol.remove")
     */
    public function remove(Symbol $symbol, SymbolFacade $symbolFacade): RedirectResponse
    {
        $symbolFacade->deleteSymbol($symbol);

        $this->addFlashSuccess(Flashes::SYMBOL_DELETED);

        return $this->redirectToRoute('admin.symbol');
    }
}

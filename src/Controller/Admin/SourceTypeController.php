<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\SourceType;
use App\Event\SourceTypeCreatedEvent;
use App\Event\SourceTypeUpdatedEvent;
use App\Facade\SourceTypeFacade;
use App\Form\SourceType\SourceTypeForm;
use App\Form\SourceType\SourceTypeFormData;
use App\Repository\SourceTypeRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/source-type")
 */
class SourceTypeController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.source-type")
     */
    public function index(SourceTypeRepository $sourceTypeRepository): Response
    {
        return $this->render(
            'admin/source-type/index.html.twig',
            [
                'sourceTypes' => $sourceTypeRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", methods={"GET", "POST"}, name="admin.source-type.add")
     */
    public function add(
        Request $request,
        SourceTypeFacade $sourceTypeFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = new SourceTypeFormData();

        $form = $this->createForm(SourceTypeForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sourceType = $sourceTypeFacade->createSourceType($formData);

            $dispatcher->dispatch(new SourceTypeCreatedEvent($this->getUser(), $sourceType));

            $this->addFlashSuccess(Flashes::SOURCE_TYPE_CREATED);

            return $this->redirectToRoute('admin.source-type');
        }

        return $this->render(
            'admin/source-type/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.source-type.edit")
     */
    public function edit(
        Request $request,
        SourceType $sourceType,
        SourceTypeFacade $sourceTypeFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = SourceTypeFormData::createFromSourceType($sourceType);

        $form = $this->createForm(SourceTypeForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sourceTypeFacade->updateSourceType($sourceType, $formData);

            $dispatcher->dispatch(new SourceTypeUpdatedEvent($this->getUser(), $sourceType));

            $this->addFlashSuccess(Flashes::SOURCE_TYPE_UPDATED);

            return $this->redirectToRoute('admin.source-type');
        }

        return $this->render(
            'admin/source-type/edit.html.twig',
            [
                'sourceType' => $sourceType,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", requirements={"id": "\d+"}, methods={"POST"}, name="admin.source-type.remove")
     */
    public function remove(SourceType $sourceType, SourceTypeFacade $sourceTypeFacade): RedirectResponse
    {
        $sourceTypeFacade->deleteSourceType($sourceType);

        $this->addFlashSuccess(Flashes::SOURCE_TYPE_DELETED);

        return $this->redirectToRoute('admin.source-type');
    }
}

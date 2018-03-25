<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\SourceType;
use App\Event\SourceTypeEvent;
use App\Events;
use App\Facade\SourceTypeFacade;
use App\Form\SourceType\SourceTypeForm;
use App\Form\SourceType\SourceTypeFormData;
use App\Repository\SourceTypeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/source-type")
 */
class SourceTypeController extends AbstractController
{
    /**
     * @Route("", name="admin.source-type")
     * @Method("GET")
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
     * @Route("/add", name="admin.source-type.add")
     * @Method({"GET", "POST"})
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

            $dispatcher->dispatch(
                Events::SOURCE_TYPE_CREATED,
                new SourceTypeEvent($this->getUser(), $sourceType)
            );

            $this->addFlashSuccess('admin.source_type.created');

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
     * @Route("/{id}/edit", name="admin.source-type.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
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

            $dispatcher->dispatch(
                Events::SOURCE_TYPE_UPDATED,
                new SourceTypeEvent($this->getUser(), $sourceType)
            );

            $this->addFlashSuccess('admin.source_type.updated');

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
     * @Route("/{id}/remove", name="admin.source-type.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(SourceType $sourceType, SourceTypeFacade $sourceTypeFacade): RedirectResponse
    {
        $sourceTypeFacade->deleteSourceType($sourceType);

        $this->addFlashSuccess('admin.source_type.deleted');

        return $this->redirectToRoute('admin.source-type');
    }
}

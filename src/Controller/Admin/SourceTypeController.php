<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\SourceType;
use App\Facade\SourceTypeFacade;
use App\Form\SourceType\SourceTypeForm;
use App\Form\SourceType\SourceTypeFormData;
use App\Repository\SourceTypeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/source-type")
 */
class SourceTypeController extends AbstractController
{
    /**
     * @var SourceTypeFacade
     */
    private $sourceTypeFacade;

    public function __construct(SourceTypeFacade $sourceTypeFacade)
    {
        $this->sourceTypeFacade = $sourceTypeFacade;
    }

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
    public function add(Request $request): Response
    {
        $formData = new SourceTypeFormData();

        $form = $this->createForm(SourceTypeForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->sourceTypeFacade->createSourceType($formData);

            $this->addFlashSuccess('source-type.created_successfully');

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
     * @Route("/{id}", name="admin.source-type.view", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function view(SourceType $sourceType): Response
    {
        return $this->render(
            'admin/source-type/view.html.twig',
            [
                'sourceType' => $sourceType,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.source-type.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, SourceType $sourceType): Response
    {
        $formData = SourceTypeFormData::createFromSourceType($sourceType);

        $form = $this->createForm(SourceTypeForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->sourceTypeFacade->updateSourceType($sourceType, $formData);

            $this->addFlashSuccess('source-type.updated_successfully');

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
    public function remove(SourceType $sourceType): RedirectResponse
    {
        $this->sourceTypeFacade->deleteSourceType($sourceType);

        $this->addFlashSuccess('source-type.deleted_successfully');

        return $this->redirectToRoute('admin.source-type');
    }
}

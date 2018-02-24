<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Source;
use App\Facade\SourceFacade;
use App\Form\Source\SourceForm;
use App\Repository\SourceRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/source")
 */
class SourceController extends AbstractController
{
    /**
     * @var SourceFacade
     */
    private $sourceFacade;

    public function __construct(SourceFacade $sourceFacade)
    {
        $this->sourceFacade = $sourceFacade;
    }

    /**
     * @Route("", name="admin.source")
     * @Method("GET")
     */
    public function index(SourceRepository $sourceRepository): Response
    {
        return $this->render(
            'admin/source/index.html.twig',
            [
                'sources' => $sourceRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.source.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $form = $this->createForm(SourceForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->sourceFacade->createSource($form->getData());

            $this->addFlashSuccess('source.created_successfully');

            return $this->redirectToRoute('admin.source');
        }

        return $this->render(
            'admin/source/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="admin.source.view", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function view(Source $source): Response
    {
        return $this->render(
            'admin/source/view.html.twig',
            [
                'source' => $source,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.source.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Source $source): Response
    {
        // todo

        return $this->render(
            'admin/source/edit.html.twig',
            [
                'source' => $source,
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.source.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(Source $source): RedirectResponse
    {
        $this->sourceFacade->deleteSource($source);

        $this->addFlashSuccess('source.deleted_successfully');

        return $this->redirectToRoute('admin.source');
    }
}

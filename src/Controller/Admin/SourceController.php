<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\Source;
use App\Event\SourceCreatedEvent;
use App\Event\SourceUpdatedEvent;
use App\Facade\SourceFacade;
use App\Form\Source\SourceForm;
use App\Form\Source\SourceFormData;
use App\Repository\SourceRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/source")
 */
class SourceController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.source")
     */
    public function index(SourceRepository $sourceRepository): Response
    {
        return $this->render(
            'admin/source/index.html.twig',
            [
                'sources' => $sourceRepository->findAllWithSourceTypes(),
            ]
        );
    }

    /**
     * @Route("/add", methods={"GET", "POST"}, name="admin.source.add")
     */
    public function add(Request $request, SourceFacade $sourceFacade, EventDispatcherInterface $dispatcher): Response
    {
        $formData = new SourceFormData();

        $form = $this->createForm(SourceForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $source = $sourceFacade->createSource($formData);

            $dispatcher->dispatch(new SourceCreatedEvent($this->getUser(), $source));

            $this->addFlashSuccess(Flashes::SOURCE_CREATED);

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
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.source.edit")
     */
    public function edit(
        Request $request,
        Source $source,
        SourceFacade $sourceFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = SourceFormData::createFromSource($source);

        $form = $this->createForm(SourceForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sourceFacade->updateSource($source, $formData);

            $dispatcher->dispatch(new SourceUpdatedEvent($this->getUser(), $source));

            $this->addFlashSuccess(Flashes::SOURCE_UPDATED);

            return $this->redirectToRoute('admin.source');
        }

        return $this->render(
            'admin/source/edit.html.twig',
            [
                'source' => $source,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", requirements={"id": "\d+"}, methods={"POST"}, name="admin.source.remove")
     */
    public function remove(Source $source, SourceFacade $sourceFacade): RedirectResponse
    {
        $sourceFacade->deleteSource($source);

        $this->addFlashSuccess(Flashes::SOURCE_DELETED);

        return $this->redirectToRoute('admin.source');
    }
}

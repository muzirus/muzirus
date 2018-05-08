<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\Source;
use App\Event\SourceEvent;
use App\Events;
use App\Facade\SourceFacade;
use App\Form\Source\SourceForm;
use App\Form\Source\SourceFormData;
use App\Repository\SourceRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/source")
 */
class SourceController extends AbstractController
{
    /**
     * @Route("", name="admin.source")
     * @Method("GET")
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
     * @Route("/add", name="admin.source.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request, SourceFacade $sourceFacade, EventDispatcherInterface $dispatcher): Response
    {
        $formData = new SourceFormData();

        $form = $this->createForm(SourceForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $source = $sourceFacade->createSource($formData);

            $dispatcher->dispatch(
                Events::SOURCE_CREATED,
                new SourceEvent($this->getUser(), $source)
            );

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
     * @Route("/{id}/edit", name="admin.source.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
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

            $dispatcher->dispatch(
                Events::SOURCE_UPDATED,
                new SourceEvent($this->getUser(), $source)
            );

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
     * @Route("/{id}/remove", name="admin.source.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(Source $source, SourceFacade $sourceFacade): RedirectResponse
    {
        $sourceFacade->deleteSource($source);

        $this->addFlashSuccess(Flashes::SOURCE_DELETED);

        return $this->redirectToRoute('admin.source');
    }
}

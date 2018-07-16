<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\Announcement;
use App\Facade\AnnouncementFacade;
use App\Form\Announcement\AnnouncementForm;
use App\Form\Announcement\AnnouncementFormData;
use App\Repository\AnnouncementRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/announcement")
 */
class AnnouncementController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.announcement")
     */
    public function index(AnnouncementRepository $announcementRepository): Response
    {
        return $this->render(
            'admin/announcement/index.html.twig',
            [
                'announcements' => $announcementRepository->findAllWithAuthorsInDescendingOrder(),
            ]
        );
    }

    /**
     * @Route("/add", methods={"GET", "POST"}, name="admin.announcement.add")
     */
    public function add(Request $request, AnnouncementFacade $announcementFacade): Response
    {
        $formData = new AnnouncementFormData();

        $form = $this->createForm(AnnouncementForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $announcement = $announcementFacade->createAnnouncement($formData);

            $this->addFlashSuccess(Flashes::ANNOUNCEMENT_CREATED);

            return $this->redirectToRoute(
                'admin.announcement.edit',
                [
                    'id' => $announcement->getId(),
                ]
            );
        }

        return $this->render(
            'admin/announcement/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.announcement.edit")
     */
    public function edit(Request $request, Announcement $announcement, AnnouncementFacade $announcementFacade): Response
    {
        $formData = AnnouncementFormData::createFromAnnouncement($announcement);

        $form = $this->createForm(AnnouncementForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $announcementFacade->updateAnnouncement($announcement, $formData);

            $this->addFlashSuccess(Flashes::ANNOUNCEMENT_UPDATED);

            return $this->redirectToRoute(
                'admin.announcement.edit',
                [
                    'id' => $announcement->getId(),
                ]
            );
        }

        return $this->render(
            'admin/announcement/edit.html.twig',
            [
                'announcement' => $announcement,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", requirements={"id": "\d+"}, methods={"POST"}, name="admin.announcement.remove")
     */
    public function remove(Announcement $announcement, AnnouncementFacade $announcementFacade): RedirectResponse
    {
        $announcementFacade->deleteAnnouncement($announcement);

        $this->addFlashSuccess(Flashes::ANNOUNCEMENT_DELETED);

        return $this->redirectToRoute('admin.announcement');
    }
}

<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\AnnouncementInterface;
use App\Factory\AnnouncementFactoryInterface;
use App\Form\Announcement\AnnouncementFormDataInterface;
use App\Service\AnnouncementUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;

class AnnouncementFacade implements AnnouncementFacadeInterface
{
    private EntityManagerInterface $entityManager;

    private AnnouncementFactoryInterface $announcementFactory;

    private AnnouncementUpdaterInterface $announcementUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        AnnouncementFactoryInterface $announcementFactory,
        AnnouncementUpdaterInterface $announcementUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->announcementFactory = $announcementFactory;
        $this->announcementUpdater = $announcementUpdater;
    }

    public function createAnnouncement(AnnouncementFormDataInterface $formData): AnnouncementInterface
    {
        $announcement = $this->announcementFactory->createFromFormData($formData);

        $this->entityManager->persist($announcement);
        $this->entityManager->flush();

        return $announcement;
    }

    public function updateAnnouncement(
        AnnouncementInterface $announcement,
        AnnouncementFormDataInterface $formData
    ): void {
        $this->announcementUpdater->updateAnnouncement($announcement, $formData);

        $this->entityManager->flush();
    }

    public function deleteAnnouncement(AnnouncementInterface $announcement): void
    {
        $this->entityManager->remove($announcement);
        $this->entityManager->flush();
    }
}

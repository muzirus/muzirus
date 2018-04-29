<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\AnnouncementInterface;
use App\Factory\AnnouncementFactory;
use App\Form\Announcement\AnnouncementFormData;
use App\Service\AnnouncementUpdater;
use Doctrine\ORM\EntityManagerInterface;

class AnnouncementFacade
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var AnnouncementFactory */
    private $announcementFactory;

    /** @var AnnouncementUpdater */
    private $announcementUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        AnnouncementFactory $announcementFactory,
        AnnouncementUpdater $announcementUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->announcementFactory = $announcementFactory;
        $this->announcementUpdater = $announcementUpdater;
    }

    public function createAnnouncement(AnnouncementFormData $formData): AnnouncementInterface
    {
        $announcement = $this->announcementFactory->createFromFormData($formData);

        $this->entityManager->persist($announcement);
        $this->entityManager->flush();

        return $announcement;
    }

    public function updateAnnouncement(AnnouncementInterface $announcement, AnnouncementFormData $formData): void
    {
        $this->announcementUpdater->updateAnnouncement($announcement, $formData);

        $this->entityManager->flush();
    }

    public function deleteAnnouncement(AnnouncementInterface $announcement): void
    {
        $this->entityManager->remove($announcement);
        $this->entityManager->flush();
    }
}

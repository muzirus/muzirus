<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\AnnouncementInterface;
use App\Factory\AnnouncementFactory;
use App\Form\Announcement\AnnouncementFormData;
use Doctrine\ORM\EntityManagerInterface;

class AnnouncementFacade
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /** @var AnnouncementFactory */
    private $announcementFactory;

    public function __construct(EntityManagerInterface $entityManager, AnnouncementFactory $announcementFactory)
    {
        $this->entityManager = $entityManager;
        $this->announcementFactory = $announcementFactory;
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
        $announcement->setTitle($formData->getTitle());
        $announcement->setContent($formData->getContent());

        $this->entityManager->flush();
    }

    public function deleteAnnouncement(AnnouncementInterface $announcement): void
    {
        $this->entityManager->remove($announcement);
        $this->entityManager->flush();
    }
}

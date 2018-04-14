<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\Announcement;
use App\Entity\AnnouncementInterface;
use App\Form\Announcement\AnnouncementFormData;
use Doctrine\ORM\EntityManagerInterface;

class AnnouncementFacade
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createAnnouncement(AnnouncementFormData $formData): AnnouncementInterface
    {
        $announcement = new Announcement(
            $formData->getTitle(),
            $formData->getContent()
        );

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

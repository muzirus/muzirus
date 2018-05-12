<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\AnnouncementInterface;
use App\Form\Announcement\AnnouncementFormDataInterface;

interface AnnouncementFacadeInterface
{
    public function createAnnouncement(AnnouncementFormDataInterface $formData): AnnouncementInterface;

    public function updateAnnouncement(
        AnnouncementInterface $announcement,
        AnnouncementFormDataInterface $formData
    ): void;

    public function deleteAnnouncement(AnnouncementInterface $announcement): void;
}

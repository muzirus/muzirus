<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\AnnouncementInterface;
use App\Form\Announcement\AnnouncementFormDataInterface;

class AnnouncementUpdater implements AnnouncementUpdaterInterface
{
    public function updateAnnouncement(
        AnnouncementInterface $abbreviation,
        AnnouncementFormDataInterface $formData
    ): void {
        $abbreviation->setTitle($formData->getTitle());
        $abbreviation->setContent($formData->getContent());
    }
}

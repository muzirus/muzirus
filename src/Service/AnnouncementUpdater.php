<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\AnnouncementInterface;
use App\Form\Announcement\AnnouncementFormData;

class AnnouncementUpdater
{
    public function updateAnnouncement(AnnouncementInterface $abbreviation, AnnouncementFormData $formData): void
    {
        $abbreviation->setTitle($formData->getTitle());
        $abbreviation->setContent($formData->getContent());
    }
}

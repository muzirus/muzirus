<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\AnnouncementInterface;
use App\Form\Announcement\AnnouncementFormDataInterface;

interface AnnouncementUpdaterInterface
{
    public function updateAnnouncement(
        AnnouncementInterface $abbreviation,
        AnnouncementFormDataInterface $formData
    ): void;
}

<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\Announcement;
use App\Entity\AnnouncementInterface;
use App\Form\Announcement\AnnouncementFormData;

class AnnouncementFactory
{
    public function createFromFormData(AnnouncementFormData $formData): AnnouncementInterface
    {
        return new Announcement(
            $formData->getTitle(),
            $formData->getContent()
        );
    }
}

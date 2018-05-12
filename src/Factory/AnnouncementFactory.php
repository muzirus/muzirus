<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\Announcement;
use App\Entity\AnnouncementInterface;
use App\Form\Announcement\AnnouncementFormDataInterface;

class AnnouncementFactory implements AnnouncementFactoryInterface
{
    public function createFromFormData(AnnouncementFormDataInterface $formData): AnnouncementInterface
    {
        return new Announcement(
            $formData->getTitle(),
            $formData->getContent()
        );
    }
}

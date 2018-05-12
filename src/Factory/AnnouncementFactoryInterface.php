<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\AnnouncementInterface;
use App\Form\Announcement\AnnouncementFormDataInterface;

interface AnnouncementFactoryInterface
{
    public function createFromFormData(AnnouncementFormDataInterface $formData): AnnouncementInterface;
}

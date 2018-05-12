<?php declare(strict_types=1);

namespace App\Form\Announcement;

interface AnnouncementFormDataInterface
{
    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getContent(): string;

    public function setContent(string $content): void;
}

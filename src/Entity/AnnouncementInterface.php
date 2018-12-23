<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;

interface AnnouncementInterface extends TimestampableInterface
{
    public function getId(): string;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getContent(): string;

    public function setContent(string $content): void;

    public function hasAuthor(): bool;

    public function getAuthor(): ?UserInterface;
}

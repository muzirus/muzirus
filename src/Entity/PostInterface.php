<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\Timestampable;

interface PostInterface extends Timestampable
{
    public function getId(): string;

    public function getSlug(): string;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getTitleInRussian(): string;

    public function setTitleInRussian(string $titleInRussian): void;

    public function getContent(): string;

    public function getContentInRussian(): string;

    public function hasAuthor(): bool;

    public function getAuthor(): UserInterface;

    public function getLastRevision(): PostRevisionInterface;
}

<?php declare(strict_types=1);

namespace App\Form\Post;

interface PostFormDataInterface
{
    public function getSlug(): string;

    public function setSlug(string $slug): void;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getTitleInRussian(): string;

    public function setTitleInRussian(string $titleInRussian): void;

    public function getContent(): string;

    public function setContent(string $content): void;

    public function getContentInRussian(): string;

    public function setContentInRussian(string $contentInRussian): void;
}

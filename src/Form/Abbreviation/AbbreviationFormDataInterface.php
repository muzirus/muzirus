<?php declare(strict_types=1);

namespace App\Form\Abbreviation;

interface AbbreviationFormDataInterface
{
    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getContent(): string;

    public function setContent(string $content): void;

    public function getDescription(): string;

    public function setDescription(string $description): void;
}

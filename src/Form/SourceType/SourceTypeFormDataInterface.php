<?php declare(strict_types=1);

namespace App\Form\SourceType;

interface SourceTypeFormDataInterface
{
    public function getTitle(): string;

    public function setTitle(string $title): void;
}

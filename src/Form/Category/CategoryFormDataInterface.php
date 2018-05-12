<?php declare(strict_types=1);

namespace App\Form\Category;

interface CategoryFormDataInterface
{
    public function getTitle(): string;

    public function setTitle(string $title): void;
}

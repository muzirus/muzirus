<?php declare(strict_types=1);

namespace App\Form\Category;

interface CategoryFormDataInterface
{
    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getTitleInRussian(): string;

    public function setTitleInRussian(string $titleInRussian): void;
}

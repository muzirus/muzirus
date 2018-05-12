<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\CategoryInterface;
use App\Form\Category\CategoryFormDataInterface;

interface CategoryUpdaterInterface
{
    public function updateCategory(CategoryInterface $category, CategoryFormDataInterface $formData): void;
}

<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\WordCategoryInterface;
use App\Form\Category\CategoryFormData;

class CategoryUpdater
{
    public function updateCategory(WordCategoryInterface $category, CategoryFormData $formData): void
    {
        $category->setTitle($formData->getTitle());
    }
}

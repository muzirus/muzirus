<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\WordCategoryInterface;
use App\Form\Category\CategoryFormDataInterface;

class CategoryUpdater implements CategoryUpdaterInterface
{
    public function updateCategory(WordCategoryInterface $category, CategoryFormDataInterface $formData): void
    {
        $category->setTitle($formData->getTitle());
    }
}

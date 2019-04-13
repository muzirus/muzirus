<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\CategoryInterface;
use App\Form\Category\CategoryFormDataInterface;

class CategoryUpdater implements CategoryUpdaterInterface
{
    public function updateCategory(CategoryInterface $category, CategoryFormDataInterface $formData): void
    {
        $category->setTitle($formData->getTitle());
        $category->setTitleInRussian($formData->getTitleInRussian());
    }
}

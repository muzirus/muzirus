<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\WordCategoryInterface as CategoryInterface;
use App\Form\Category\CategoryFormDataInterface;

interface CategoryFacadeInterface
{
    public function createCategory(CategoryFormDataInterface $formData): CategoryInterface;

    public function updateCategory(CategoryInterface $category, CategoryFormDataInterface $formData): void;

    public function deleteCategory(CategoryInterface $category): void;
}

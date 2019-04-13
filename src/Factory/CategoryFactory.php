<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\Category;
use App\Entity\CategoryInterface;
use App\Form\Category\CategoryFormDataInterface;

class CategoryFactory implements CategoryFactoryInterface
{
    public function createFromFormData(CategoryFormDataInterface $formData): CategoryInterface
    {
        return new Category($formData->getTitle(), $formData->getTitleInRussian());
    }
}

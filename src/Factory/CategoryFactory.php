<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\WordCategory;
use App\Entity\WordCategoryInterface;
use App\Form\Category\CategoryFormDataInterface;

class CategoryFactory
{
    public function createFromFormData(CategoryFormDataInterface $formData): WordCategoryInterface
    {
        return new WordCategory($formData->getTitle());
    }
}

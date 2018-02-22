<?php

namespace App\Factory;

use App\Entity\WordCategory;
use App\Entity\WordCategoryInterface;
use App\Form\Category\CategoryFormData;

class CategoryFactory
{
    public function createCategoryFromFormData(CategoryFormData $formData): WordCategoryInterface
    {
        return new WordCategory($formData->getTitle());
    }
}

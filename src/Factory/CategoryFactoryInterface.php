<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\WordCategoryInterface;
use App\Form\Category\CategoryFormDataInterface;

interface CategoryFactoryInterface
{
    public function createFromFormData(CategoryFormDataInterface $formData): WordCategoryInterface;
}

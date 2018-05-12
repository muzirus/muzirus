<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\CategoryInterface;
use App\Form\Category\CategoryFormDataInterface;

interface CategoryFactoryInterface
{
    public function createFromFormData(CategoryFormDataInterface $formData): CategoryInterface;
}

<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\TranslationExampleInterface;
use App\Form\TranslationExample\TranslationExampleFormDataInterface;

interface TranslationExampleFactoryInterface
{
    public function createFromFormData(TranslationExampleFormDataInterface $formData): TranslationExampleInterface;
}

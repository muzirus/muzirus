<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\TranslationInterface;
use App\Form\Translation\TranslationFormDataInterface;

interface TranslationFactoryInterface
{
    public function createFromFormData(TranslationFormDataInterface $formData): TranslationInterface;
}

<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\TranslationExampleInterface;
use App\Form\TranslationExample\TranslationExampleFormDataInterface;

interface TranslationExampleUpdaterInterface
{
    public function updateTranslationExample(
        TranslationExampleInterface $translationExample,
        TranslationExampleFormDataInterface $formData
    ): void;
}

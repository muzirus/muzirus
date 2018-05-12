<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\TranslationExampleInterface;
use App\Form\TranslationExample\TranslationExampleFormDataInterface;

interface TranslationExampleFacadeInterface
{
    public function createTranslationExample(
        TranslationExampleFormDataInterface $formData
    ): TranslationExampleInterface;

    public function updateTranslationExample(
        TranslationExampleInterface $translationExample,
        TranslationExampleFormDataInterface $formData
    ): void;

    public function deleteTranslationExample(TranslationExampleInterface $translationExample): void;
}

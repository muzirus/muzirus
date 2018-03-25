<?php

namespace App\Factory;

use App\Entity\TranslationExample;
use App\Entity\TranslationExampleInterface;
use App\Form\TranslationExample\TranslationExampleFormData;

class TranslationExampleFactory
{
    public function createFromFormData(TranslationExampleFormData $formData): TranslationExampleInterface
    {
        return new TranslationExample(
            $formData->getTranslation(),
            $formData->getRussianWordSentence(),
            $formData->getCzechWordSentence(),
            $formData->isHidden()
        );
    }
}

<?php

namespace App\Factory;

use App\Entity\Translation;
use App\Entity\TranslationInterface;
use App\Form\Translation\TranslationFormDataInterface;

class TranslationFactory
{
    public function createFromFormData(TranslationFormDataInterface $formData): TranslationInterface
    {
        $translation = new Translation(
            $formData->getRussianWord(),
            $formData->getCzechWord()
        );

        $translation->setCzechWordNote($formData->getCzechWordNote());
        $translation->setRussianWordNote($formData->getRussianWordNote());

        return $translation;
    }
}

<?php

namespace App\Form\Translation;

use App\Entity\TranslationInterface;

class UpdateTranslationFormData extends AbstractTranslationFormData implements UpdateTranslationFormDataInterface
{
    public static function fromTranslation(TranslationInterface $translation): self
    {
        $formData = new self();

        $formData->setRussianWordNote($translation->getRussianWordNote());
        $formData->setCzechWordNote($translation->getCzechWordNote());

        return $formData;
    }
}

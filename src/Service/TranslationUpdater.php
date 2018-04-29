<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\TranslationInterface;
use App\Form\Translation\TranslationFormData;

class TranslationUpdater
{
    public function updateTranslation(TranslationInterface $translation, TranslationFormData $formData): void
    {
        $translation->setRussianWord($formData->getRussianWord());
        $translation->setRussianWordNote($formData->getRussianWordNote());
        $translation->setCzechWord($formData->getCzechWord());
        $translation->setCzechWordNote($formData->getCzechWordNote());
        $translation->setLink($formData->getLink());
    }
}

<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\TranslationExampleInterface;
use App\Form\TranslationExample\TranslationExampleFormData;

class TranslationExampleUpdater
{
    public function updateTranslationExample(
        TranslationExampleInterface $translationExample,
        TranslationExampleFormData $formData
    ): void {
        $translationExample->setRussianWordSentence($formData->getRussianWordSentence());
        $translationExample->setCzechWordSentence($formData->getCzechWordSentence());

        if ($formData->isHidden()) {
            $translationExample->markHidden();
        } else {
            $translationExample->markVisible();
        }
    }
}

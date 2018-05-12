<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\TranslationExampleInterface;
use App\Form\TranslationExample\TranslationExampleFormDataInterface;

class TranslationExampleUpdater
{
    public function updateTranslationExample(
        TranslationExampleInterface $translationExample,
        TranslationExampleFormDataInterface $formData
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

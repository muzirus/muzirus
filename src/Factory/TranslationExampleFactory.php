<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\TranslationExample;
use App\Entity\TranslationExampleInterface;
use App\Form\TranslationExample\TranslationExampleFormDataInterface;

class TranslationExampleFactory implements TranslationExampleFactoryInterface
{
    public function createFromFormData(TranslationExampleFormDataInterface $formData): TranslationExampleInterface
    {
        return new TranslationExample(
            $formData->getTranslation(),
            $formData->getRussianWordSentence(),
            $formData->getCzechWordSentence(),
            $formData->isHidden()
        );
    }
}

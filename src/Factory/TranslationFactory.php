<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\CzechWordInterface;
use App\Entity\RussianWordInterface;
use App\Entity\Translation;
use App\Entity\TranslationInterface;
use App\Form\Translation\TranslationFormDataInterface;
use Webmozart\Assert\Assert;

class TranslationFactory implements TranslationFactoryInterface
{
    public function createFromFormData(TranslationFormDataInterface $formData): TranslationInterface
    {
        Assert::isInstanceOf($formData->getCzechWord(), CzechWordInterface::class);
        Assert::isInstanceOf($formData->getRussianWord(), RussianWordInterface::class);

        $translation = new Translation(
            $formData->getRussianWord(),
            $formData->getCzechWord()
        );

        $translation->setCzechWordNote($formData->getCzechWordNote());
        $translation->setRussianWordNote($formData->getRussianWordNote());
        $translation->setLink($formData->getLink());

        return $translation;
    }
}

<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\CzechWordInterface;
use App\Entity\RussianWordInterface;
use App\Entity\TranslationInterface;
use App\Form\Translation\TranslationFormDataInterface;
use Webmozart\Assert\Assert;

class TranslationUpdater implements TranslationUpdaterInterface
{
    public function updateTranslation(TranslationInterface $translation, TranslationFormDataInterface $formData): void
    {
        Assert::isInstanceOf($formData->getCzechWord(), CzechWordInterface::class);
        Assert::isInstanceOf($formData->getRussianWord(), RussianWordInterface::class);

        $translation->setRussianWord($formData->getRussianWord());
        $translation->setRussianWordNote($formData->getRussianWordNote());
        $translation->setCzechWord($formData->getCzechWord());
        $translation->setCzechWordNote($formData->getCzechWordNote());
        $translation->setLink($formData->getLink());
    }
}

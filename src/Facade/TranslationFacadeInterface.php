<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\TranslationInterface;
use App\Form\Translation\TranslationFormDataInterface;

interface TranslationFacadeInterface
{
    public function createTranslation(TranslationFormDataInterface $formData): TranslationInterface;

    public function updateTranslation(TranslationInterface $translation, TranslationFormDataInterface $formData): void;

    public function deleteTranslation(TranslationInterface $translation): void;

    public function updateTranslationPositionInRussianWordDetail(TranslationInterface $translation, string $move): void;

    public function updateTranslationPositionInCzechWordDetail(TranslationInterface $translation, string $move): void;
}

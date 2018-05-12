<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\TranslationInterface;
use App\Form\Translation\TranslationFormDataInterface;

interface TranslationUpdaterInterface
{
    public function updateTranslation(TranslationInterface $translation, TranslationFormDataInterface $formData): void;
}

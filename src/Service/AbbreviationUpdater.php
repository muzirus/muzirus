<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\AbbreviationInterface;
use App\Form\Abbreviation\AbbreviationFormData;

class AbbreviationUpdater
{
    public function updateAbbreviation(AbbreviationInterface $abbreviation, AbbreviationFormData $formData): void
    {
        $abbreviation->setTitle($formData->getTitle());
        $abbreviation->setContent($formData->getContent());
        $abbreviation->setDescription($formData->getDescription());
    }
}

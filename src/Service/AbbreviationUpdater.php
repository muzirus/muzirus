<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\AbbreviationInterface;
use App\Form\Abbreviation\AbbreviationFormDataInterface;

class AbbreviationUpdater implements AbbreviationUpdaterInterface
{
    public function updateAbbreviation(
        AbbreviationInterface $abbreviation,
        AbbreviationFormDataInterface $formData
    ): void {
        $abbreviation->setTitle($formData->getTitle());
        $abbreviation->setContent($formData->getContent());
        $abbreviation->setDescription($formData->getDescription());
    }
}

<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\AbbreviationInterface;
use App\Form\Abbreviation\AbbreviationFormDataInterface;

interface AbbreviationFacadeInterface
{
    public function createAbbreviation(AbbreviationFormDataInterface $formData): AbbreviationInterface;

    public function updateAbbreviation(
        AbbreviationInterface $abbreviation,
        AbbreviationFormDataInterface $formData
    ): void;

    public function deleteAbbreviation(AbbreviationInterface $abbreviation): void;
}

<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\AbbreviationInterface;
use App\Form\Abbreviation\AbbreviationFormDataInterface;

interface AbbreviationUpdaterInterface
{
    public function updateAbbreviation(
        AbbreviationInterface $abbreviation,
        AbbreviationFormDataInterface $formData
    ): void;
}

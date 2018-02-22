<?php

namespace App\Factory;

use App\Entity\Abbreviation;
use App\Form\Abbreviation\AbbreviationFormData;

class AbbreviationFactory
{
    public function createFromFormData(AbbreviationFormData $formData): Abbreviation
    {
        return new Abbreviation(
            $formData->getTitle(),
            $formData->getContent(),
            $formData->getDescription()
        );
    }
}

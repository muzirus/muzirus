<?php

namespace App\Factory;

use App\Entity\Abbreviation;
use App\FormData\AbbreviationFormData;

class AbbreviationFactory
{
    public function createFromFormData(AbbreviationFormData $formData): Abbreviation
    {
        $abbreviation = new Abbreviation(
            $formData->getTitle(),
            $formData->getContent(),
            $formData->getDescription()
        );

        return $abbreviation;
    }
}

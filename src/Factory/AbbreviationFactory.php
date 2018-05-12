<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\Abbreviation;
use App\Entity\AbbreviationInterface;
use App\Form\Abbreviation\AbbreviationFormDataInterface;

class AbbreviationFactory implements AbbreviationFactoryInterface
{
    public function createFromFormData(AbbreviationFormDataInterface $formData): AbbreviationInterface
    {
        return new Abbreviation(
            $formData->getTitle(),
            $formData->getContent(),
            $formData->getDescription()
        );
    }
}

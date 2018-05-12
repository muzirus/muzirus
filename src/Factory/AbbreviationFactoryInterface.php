<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\AbbreviationInterface;
use App\Form\Abbreviation\AbbreviationFormDataInterface;

interface AbbreviationFactoryInterface
{
    public function createFromFormData(AbbreviationFormDataInterface $formData): AbbreviationInterface;
}

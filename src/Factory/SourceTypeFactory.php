<?php

namespace App\Factory;

use App\Entity\SourceType;
use App\Entity\SourceTypeInterface;
use App\Form\SourceType\SourceTypeFormData;

class SourceTypeFactory
{
    public function createSourceTypeFromFormData(SourceTypeFormData $formData): SourceTypeInterface
    {
        return new SourceType($formData->getTitle());
    }
}

<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\SourceType;
use App\Entity\SourceTypeInterface;
use App\Form\SourceType\SourceTypeFormData;

class SourceTypeFactory
{
    public function createFromFormData(SourceTypeFormData $formData): SourceTypeInterface
    {
        return new SourceType($formData->getTitle());
    }
}

<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\SourceType;
use App\Entity\SourceTypeInterface;
use App\Form\SourceType\SourceTypeFormDataInterface;

class SourceTypeFactory implements SourceTypeFactoryInterface
{
    public function createFromFormData(SourceTypeFormDataInterface $formData): SourceTypeInterface
    {
        return new SourceType($formData->getTitle());
    }
}

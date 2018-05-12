<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\SourceTypeInterface;
use App\Form\SourceType\SourceTypeFormDataInterface;

interface SourceTypeFactoryInterface
{
    public function createFromFormData(SourceTypeFormDataInterface $formData): SourceTypeInterface;
}

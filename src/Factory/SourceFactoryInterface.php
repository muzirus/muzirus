<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\SourceInterface;
use App\Form\Source\SourceFormDataInterface;

interface SourceFactoryInterface
{
    public function createFromFormData(SourceFormDataInterface $formData): SourceInterface;
}

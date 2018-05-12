<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\SourceTypeInterface;
use App\Form\SourceType\SourceTypeFormDataInterface;

interface SourceTypeFacadeInterface
{
    public function createSourceType(SourceTypeFormDataInterface $formData): SourceTypeInterface;

    public function updateSourceType(SourceTypeInterface $sourceType, SourceTypeFormDataInterface $formData): void;

    public function deleteSourceType(SourceTypeInterface $sourceType): void;
}

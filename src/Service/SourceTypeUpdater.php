<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\SourceTypeInterface;
use App\Form\SourceType\SourceTypeFormData;

class SourceTypeUpdater
{
    public function updateSourceType(SourceTypeInterface $sourceType, SourceTypeFormData $formData): void
    {
        $sourceType->setTitle($formData->getTitle());
    }
}

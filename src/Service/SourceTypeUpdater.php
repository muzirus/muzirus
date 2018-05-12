<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\SourceTypeInterface;
use App\Form\SourceType\SourceTypeFormDataInterface;

class SourceTypeUpdater implements SourceTypeUpdaterInterface
{
    public function updateSourceType(SourceTypeInterface $sourceType, SourceTypeFormDataInterface $formData): void
    {
        $sourceType->setTitle($formData->getTitle());
    }
}

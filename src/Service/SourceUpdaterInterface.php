<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\SourceInterface;
use App\Form\Source\SourceFormDataInterface;

interface SourceUpdaterInterface
{
    public function updateSource(SourceInterface $source, SourceFormDataInterface $formData): void;
}

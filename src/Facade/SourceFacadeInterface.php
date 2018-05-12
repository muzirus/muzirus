<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\SourceInterface;
use App\Form\Source\SourceFormDataInterface;

interface SourceFacadeInterface
{
    public function createSource(SourceFormDataInterface $formData): SourceInterface;

    public function updateSource(SourceInterface $source, SourceFormDataInterface $formData): void;

    public function deleteSource(SourceInterface $source): void;
}

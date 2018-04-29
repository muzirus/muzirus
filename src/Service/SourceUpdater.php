<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\SourceInterface;
use App\Form\Source\SourceFormData;

class SourceUpdater
{
    public function updateSource(SourceInterface $source, SourceFormData $formData): void
    {
        $source->setTitle($formData->getTitle());
        $source->setType($formData->getType());
        $source->setNameOfAuthor($formData->getNameOfAuthor());
        $source->setNameOfPublisher($formData->getNameOfPublisher());
        $source->setDateOfRelease($formData->getDateOfRelease());
        $source->setPlaceOfRelease($formData->getPlaceOfRelease());
        $source->setPagesCount($formData->getPagesCount());
        $source->setIsbnCode($formData->getIsbnCode());
        $source->setNote($formData->getNote());
    }
}

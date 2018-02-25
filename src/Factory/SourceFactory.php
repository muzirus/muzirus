<?php

namespace App\Factory;

use App\Entity\Source;
use App\Entity\SourceInterface;
use App\Form\Source\SourceFormData;
use App\Repository\SourceTypeRepository;

class SourceFactory
{
    /**
     * @var SourceTypeRepository
     */
    private $sourceTypeRepository;

    public function __construct(SourceTypeRepository $sourceTypeRepository)
    {
        $this->sourceTypeRepository = $sourceTypeRepository;
    }

    public function createSourceFromFormData(SourceFormData $formData): SourceInterface
    {
        $source = new Source($formData->getTitle(), $formData->getType());

        $source->setNameOfAuthor($formData->getNameOfAuthor());
        $source->setNameOfPublisher($formData->getNameOfPublisher());
        $source->setDateOfRelease($formData->getDateOfRelease());
        $source->setPlaceOfRelease($formData->getPlaceOfRelease());
        $source->setPagesCount($formData->getPagesCount());
        $source->setIsbnCode($formData->getIsbnCode());
        $source->setNote($formData->getNote());

        return $source;
    }
}

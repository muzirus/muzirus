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

    /**
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function createSourceFromFormData(SourceFormData $formData): SourceInterface
    {
        $sourceType = $this->sourceTypeRepository->getOneById($formData->getTypeId());

        $source = new Source(
            $formData->getTitle(),
            $sourceType
        );

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

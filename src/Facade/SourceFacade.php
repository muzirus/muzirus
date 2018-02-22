<?php

namespace App\Facade;

use App\Entity\SourceInterface;
use App\Factory\SourceFactory;
use App\Form\Source\SourceFormData;
use Doctrine\ORM\EntityManagerInterface;

class SourceFacade
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SourceFactory
     */
    private $sourceFactory;

    public function __construct(EntityManagerInterface $entityManager, SourceFactory $sourceFactory)
    {
        $this->entityManager = $entityManager;
        $this->sourceFactory = $sourceFactory;
    }

    /**
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function createSource(SourceFormData $formData): SourceInterface
    {
        $source = $this->sourceFactory->createSourceFromFormData($formData);

        $this->entityManager->persist($source);
        $this->entityManager->flush();

        return $source;
    }

    public function updateSource(SourceInterface $source, SourceFormData $formData): void
    {
        $source->setTitle($formData->getTitle());
        //$source->setType(...) todo: set title
        $source->setNameOfAuthor($formData->getNameOfAuthor());
        $source->setNameOfPublisher($formData->getNameOfPublisher());
        $source->setDateOfRelease($formData->getDateOfRelease());
        $source->setPlaceOfRelease($formData->getPlaceOfRelease());
        $source->setPagesCount($formData->getPagesCount());
        $source->setIsbnCode($formData->getIsbnCode());
        $source->setNote($formData->getNote());

        $this->entityManager->flush();
    }

    public function deleteSource(SourceInterface $source): void
    {
        $this->entityManager->remove($source);
        $this->entityManager->flush();
    }
}

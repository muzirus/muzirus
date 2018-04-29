<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\SourceInterface;
use App\Factory\SourceFactory;
use App\Form\Source\SourceFormData;
use Doctrine\ORM\EntityManagerInterface;

class SourceFacade
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var SourceFactory */
    private $sourceFactory;

    public function __construct(EntityManagerInterface $entityManager, SourceFactory $sourceFactory)
    {
        $this->entityManager = $entityManager;
        $this->sourceFactory = $sourceFactory;
    }

    public function createSource(SourceFormData $formData): SourceInterface
    {
        $source = $this->sourceFactory->createFromFormData($formData);

        $this->entityManager->persist($source);
        $this->entityManager->flush();

        return $source;
    }

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

        $this->entityManager->flush();
    }

    public function deleteSource(SourceInterface $source): void
    {
        $this->entityManager->remove($source);
        $this->entityManager->flush();
    }
}

<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\SourceTypeInterface;
use App\Factory\SourceTypeFactory;
use App\Form\SourceType\SourceTypeFormData;
use Doctrine\ORM\EntityManagerInterface;

class SourceTypeFacade
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SourceTypeFactory
     */
    private $sourceTypeFactory;

    public function __construct(EntityManagerInterface $entityManager, SourceTypeFactory $sourceTypeFactory)
    {
        $this->entityManager = $entityManager;
        $this->sourceTypeFactory = $sourceTypeFactory;
    }

    public function createSourceType(SourceTypeFormData $formData): SourceTypeInterface
    {
        $sourceType = $this->sourceTypeFactory->createFromFormData($formData);

        $this->entityManager->persist($sourceType);
        $this->entityManager->flush();

        return $sourceType;
    }

    public function updateSourceType(SourceTypeInterface $sourceType, SourceTypeFormData $formData): void
    {
        $sourceType->setTitle($formData->getTitle());

        $this->entityManager->flush();
    }

    public function deleteSourceType(SourceTypeInterface $sourceType): void
    {
        $this->entityManager->remove($sourceType);
        $this->entityManager->flush();
    }
}

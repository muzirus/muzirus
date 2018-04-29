<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\SourceTypeInterface;
use App\Factory\SourceTypeFactory;
use App\Form\SourceType\SourceTypeFormData;
use App\Service\SourceTypeUpdater;
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

    /** @var SourceTypeUpdater */
    private $sourceTypeUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        SourceTypeFactory $sourceTypeFactory,
        SourceTypeUpdater $sourceTypeUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->sourceTypeFactory = $sourceTypeFactory;
        $this->sourceTypeUpdater = $sourceTypeUpdater;
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
        $this->sourceTypeUpdater->updateSourceType($sourceType, $formData);

        $this->entityManager->flush();
    }

    public function deleteSourceType(SourceTypeInterface $sourceType): void
    {
        $this->entityManager->remove($sourceType);
        $this->entityManager->flush();
    }
}

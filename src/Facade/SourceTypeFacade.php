<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\SourceTypeInterface;
use App\Factory\SourceTypeFactoryInterface;
use App\Form\SourceType\SourceTypeFormDataInterface;
use App\Service\SourceTypeUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;

class SourceTypeFacade implements SourceTypeFacadeInterface
{
    private EntityManagerInterface $entityManager;

    private SourceTypeFactoryInterface $sourceTypeFactory;

    private SourceTypeUpdaterInterface $sourceTypeUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        SourceTypeFactoryInterface $sourceTypeFactory,
        SourceTypeUpdaterInterface $sourceTypeUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->sourceTypeFactory = $sourceTypeFactory;
        $this->sourceTypeUpdater = $sourceTypeUpdater;
    }

    public function createSourceType(SourceTypeFormDataInterface $formData): SourceTypeInterface
    {
        $sourceType = $this->sourceTypeFactory->createFromFormData($formData);

        $this->entityManager->persist($sourceType);
        $this->entityManager->flush();

        return $sourceType;
    }

    public function updateSourceType(SourceTypeInterface $sourceType, SourceTypeFormDataInterface $formData): void
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

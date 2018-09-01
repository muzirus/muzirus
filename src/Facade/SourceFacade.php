<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\SourceInterface;
use App\Factory\SourceFactoryInterface;
use App\Form\Source\SourceFormDataInterface;
use App\Service\SourceUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;

class SourceFacade implements SourceFacadeInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var SourceFactoryInterface */
    private $sourceFactory;

    /** @var SourceUpdaterInterface */
    private $sourceUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        SourceFactoryInterface $sourceFactory,
        SourceUpdaterInterface $sourceUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->sourceFactory = $sourceFactory;
        $this->sourceUpdater = $sourceUpdater;
    }

    public function createSource(SourceFormDataInterface $formData): SourceInterface
    {
        $source = $this->sourceFactory->createFromFormData($formData);

        $this->entityManager->persist($source);
        $this->entityManager->flush();

        return $source;
    }

    public function updateSource(SourceInterface $source, SourceFormDataInterface $formData): void
    {
        $this->sourceUpdater->updateSource($source, $formData);

        $this->entityManager->flush();
    }

    public function deleteSource(SourceInterface $source): void
    {
        $this->entityManager->remove($source);
        $this->entityManager->flush();
    }
}

<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\AbbreviationInterface;
use App\Factory\AbbreviationFactoryInterface;
use App\Form\Abbreviation\AbbreviationFormDataInterface;
use App\Service\AbbreviationUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;

class AbbreviationFacade implements AbbreviationFacadeInterface
{
    private EntityManagerInterface $entityManager;

    private AbbreviationFactoryInterface $abbreviationFactory;

    private AbbreviationUpdaterInterface $abbreviationUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        AbbreviationFactoryInterface $abbreviationFactory,
        AbbreviationUpdaterInterface $abbreviationUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->abbreviationFactory = $abbreviationFactory;
        $this->abbreviationUpdater = $abbreviationUpdater;
    }

    public function createAbbreviation(AbbreviationFormDataInterface $formData): AbbreviationInterface
    {
        $abbreviation = $this->abbreviationFactory->createFromFormData($formData);

        $this->entityManager->persist($abbreviation);
        $this->entityManager->flush();

        return $abbreviation;
    }

    public function updateAbbreviation(
        AbbreviationInterface $abbreviation,
        AbbreviationFormDataInterface $formData
    ): void {
        $this->abbreviationUpdater->updateAbbreviation($abbreviation, $formData);

        $this->entityManager->flush();
    }

    public function deleteAbbreviation(AbbreviationInterface $abbreviation): void
    {
        $this->entityManager->remove($abbreviation);
        $this->entityManager->flush();
    }
}

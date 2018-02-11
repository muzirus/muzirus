<?php

namespace App\Facade;

use App\Entity\Abbreviation;
use App\Factory\AbbreviationFactory;
use App\FormData\AbbreviationFormData;
use Doctrine\ORM\EntityManagerInterface;

class AbbreviationFacade
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var AbbreviationFactory
     */
    private $abbreviationFactory;

    public function __construct(EntityManagerInterface $entityManager, AbbreviationFactory $abbreviationFactory)
    {
        $this->entityManager = $entityManager;
        $this->abbreviationFactory = $abbreviationFactory;
    }

    public function createAbbreviation(AbbreviationFormData $formData): Abbreviation
    {
        $abbreviation = $this->abbreviationFactory->createFromFormData($formData);

        $this->entityManager->persist($abbreviation);
        $this->entityManager->flush();

        return $abbreviation;
    }

    public function deleteAbbreviation(Abbreviation $abbreviation): void
    {
        $this->entityManager->remove($abbreviation);
        $this->entityManager->flush();
    }
}

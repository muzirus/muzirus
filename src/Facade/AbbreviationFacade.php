<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\AbbreviationInterface;
use App\Factory\AbbreviationFactory;
use App\Form\Abbreviation\AbbreviationFormData;
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

    public function createAbbreviation(AbbreviationFormData $formData): AbbreviationInterface
    {
        $abbreviation = $this->abbreviationFactory->createFromFormData($formData);

        $this->entityManager->persist($abbreviation);
        $this->entityManager->flush();

        return $abbreviation;
    }

    public function updateAbbreviation(AbbreviationInterface $abbreviation, AbbreviationFormData $formData): void
    {
        $abbreviation->setTitle($formData->getTitle());
        $abbreviation->setContent($formData->getContent());
        $abbreviation->setDescription($formData->getDescription());

        $this->entityManager->flush();
    }

    public function deleteAbbreviation(AbbreviationInterface $abbreviation): void
    {
        $this->entityManager->remove($abbreviation);
        $this->entityManager->flush();
    }
}

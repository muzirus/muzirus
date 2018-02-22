<?php

namespace App\Facade;

use App\Entity\RussianWordInterface;
use App\Factory\RussianWordFactory;
use App\Form\Word\RussianWordFormData;
use Doctrine\ORM\EntityManagerInterface;

class RussianWordFacade
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RussianWordFactory
     */
    private $russianWordFactory;

    public function __construct(EntityManagerInterface $entityManager, RussianWordFactory $russianWordFactory)
    {
        $this->entityManager = $entityManager;
        $this->russianWordFactory = $russianWordFactory;
    }

    public function createWord(RussianWordFormData $formData): RussianWordInterface
    {
        $russianWord = $this->russianWordFactory->createFromFormData($formData);

        $this->entityManager->persist($russianWord);
        $this->entityManager->flush();

        return $russianWord;
    }

    public function updateWord(RussianWordInterface $russianWord, RussianWordFormData $formData): void
    {
        $russianWord->setContent($formData->getContent());

        // todo: add other things

        $this->entityManager->flush();
    }

    public function deleteWord(RussianWordInterface $russianWord): void
    {
        $this->entityManager->remove($russianWord);
        $this->entityManager->flush();
    }
}

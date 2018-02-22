<?php

namespace App\Facade;

use App\Entity\CzechWordInterface;
use App\Factory\CzechWordFactory;
use App\Form\Word\CzechWordFormData;
use Doctrine\ORM\EntityManagerInterface;

class CzechWordFacade
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var CzechWordFactory
     */
    private $czechWordFactory;

    public function __construct(EntityManagerInterface $entityManager, CzechWordFactory $czechWordFactory)
    {
        $this->entityManager = $entityManager;
        $this->czechWordFactory = $czechWordFactory;
    }

    public function createWord(CzechWordFormData $formData): CzechWordInterface
    {
        $czechWord = $this->czechWordFactory->createFromFormData($formData);

        $this->entityManager->persist($czechWord);
        $this->entityManager->flush();

        return $czechWord;
    }

    public function updateWord(CzechWordInterface $czechWord, CzechWordFormData $formData): void
    {
        $czechWord->setContent($formData->getContent());

        // todo: add other things

        $this->entityManager->flush();
    }

    public function deleteWord(CzechWordInterface $czechWord): void
    {
        $this->entityManager->remove($czechWord);
        $this->entityManager->flush();
    }
}

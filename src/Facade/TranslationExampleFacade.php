<?php

namespace App\Facade;

use App\Entity\TranslationExample;
use App\Entity\TranslationExampleInterface;
use App\Entity\TranslationInterface;
use App\Form\TranslationExample\TranslationExampleFormData;
use Doctrine\ORM\EntityManagerInterface;

class TranslationExampleFacade
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createTranslationExample(TranslationInterface $translation, TranslationExampleFormData $formData): TranslationExampleInterface
    {
        $translationExample = new TranslationExample(
            $translation,
            $formData->getRussianWordSentence(),
            $formData->getCzechWordSentence()
        );

        $this->entityManager->persist($translationExample);
        $this->entityManager->flush();

        return $translationExample;
    }

    public function updateTranslationExample(TranslationExampleInterface $translationExample, TranslationExampleFormData $formData): void
    {
        $translationExample->setRussianWordSentence($formData->getRussianWordSentence());
        $translationExample->setCzechWordSentence($formData->getCzechWordSentence());

        $this->entityManager->flush();
    }

    public function deleteTranslationExample(TranslationExampleInterface $translationExample): void
    {
        $this->entityManager->remove($translationExample);
        $this->entityManager->flush();
    }
}

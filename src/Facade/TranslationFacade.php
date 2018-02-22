<?php

namespace App\Facade;

use App\Entity\TranslationInterface;
use App\Form\Translation\TranslationFormData;
use Doctrine\ORM\EntityManagerInterface;

class TranslationFacade
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TranslationFactory
     */
    private $translationFactory;

    public function __construct(EntityManagerInterface $entityManager, TranslationFactory $translationFactory)
    {
        $this->entityManager = $entityManager;
        $this->translationFactory = $translationFactory;
    }

    public function createTranslation(TranslationFormData $formData): TranslationInterface
    {
        $translation = $this->translationFactory->createTranslationFromFormData($formData);

        $this->entityManager->persist($translation);
        $this->entityManager->flush();

        return $translation;
    }

    public function updateTranslation(TranslationInterface $translation, TranslationFormData $formData): void
    {
        $translation->setCzechWordNote($formData->getCzechWordNote());
        $translation->setRussianWordNote($formData->getRussianWordNote());

        $this->entityManager->flush();
    }

    public function deleteTranslation(TranslationInterface $translation): void
    {
        $this->entityManager->remove($translation);
        $this->entityManager->flush();
    }
}

<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\TranslationExampleInterface;
use App\Factory\TranslationExampleFactory;
use App\Form\TranslationExample\TranslationExampleFormData;
use Doctrine\ORM\EntityManagerInterface;

class TranslationExampleFacade
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var TranslationExampleFactory */
    private $translationExampleFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        TranslationExampleFactory $translationExampleFactory
    ) {
        $this->entityManager = $entityManager;
        $this->translationExampleFactory = $translationExampleFactory;
    }

    public function createTranslationExample(TranslationExampleFormData $formData): TranslationExampleInterface
    {
        $translationExample = $this->translationExampleFactory->createFromFormData($formData);

        $this->entityManager->persist($translationExample);
        $this->entityManager->flush();

        return $translationExample;
    }

    public function updateTranslationExample(
        TranslationExampleInterface $translationExample,
        TranslationExampleFormData $formData
    ): void {
        $translationExample->setRussianWordSentence($formData->getRussianWordSentence());
        $translationExample->setCzechWordSentence($formData->getCzechWordSentence());

        if ($formData->isHidden()) {
            $translationExample->markHidden();
        } else {
            $translationExample->markVisible();
        }

        $this->entityManager->flush();
    }

    public function deleteTranslationExample(TranslationExampleInterface $translationExample): void
    {
        $this->entityManager->remove($translationExample);
        $this->entityManager->flush();
    }
}

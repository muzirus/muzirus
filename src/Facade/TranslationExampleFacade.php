<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\TranslationExampleInterface;
use App\Factory\TranslationExampleFactory;
use App\Form\TranslationExample\TranslationExampleFormData;
use App\Service\TranslationExampleUpdater;
use Doctrine\ORM\EntityManagerInterface;

class TranslationExampleFacade
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var TranslationExampleFactory */
    private $translationExampleFactory;

    /** @var TranslationExampleUpdater */
    private $translationExampleUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        TranslationExampleFactory $translationExampleFactory,
        TranslationExampleUpdater $translationExampleUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->translationExampleFactory = $translationExampleFactory;
        $this->translationExampleUpdater = $translationExampleUpdater;
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
        $this->translationExampleUpdater->updateTranslationExample($translationExample, $formData);

        $this->entityManager->flush();
    }

    public function deleteTranslationExample(TranslationExampleInterface $translationExample): void
    {
        $this->entityManager->remove($translationExample);
        $this->entityManager->flush();
    }
}

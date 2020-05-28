<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\TranslationExampleInterface;
use App\Factory\TranslationExampleFactoryInterface;
use App\Form\TranslationExample\TranslationExampleFormDataInterface;
use App\Service\TranslationExampleUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;

class TranslationExampleFacade implements TranslationExampleFacadeInterface
{
    private EntityManagerInterface $entityManager;

    private TranslationExampleFactoryInterface $translationExampleFactory;

    private TranslationExampleUpdaterInterface $translationExampleUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        TranslationExampleFactoryInterface $translationExampleFactory,
        TranslationExampleUpdaterInterface $translationExampleUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->translationExampleFactory = $translationExampleFactory;
        $this->translationExampleUpdater = $translationExampleUpdater;
    }

    public function createTranslationExample(TranslationExampleFormDataInterface $formData): TranslationExampleInterface
    {
        $translationExample = $this->translationExampleFactory->createFromFormData($formData);

        $this->entityManager->persist($translationExample);
        $this->entityManager->flush();

        return $translationExample;
    }

    public function updateTranslationExample(
        TranslationExampleInterface $translationExample,
        TranslationExampleFormDataInterface $formData
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

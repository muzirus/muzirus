<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\TranslationInterface;
use App\Factory\TranslationFactory;
use App\Form\Translation\TranslationFormDataInterface;
use App\Service\TranslationUpdater;
use Doctrine\ORM\EntityManagerInterface;

class TranslationFacade implements TranslationFacadeInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var TranslationFactory */
    private $translationFactory;

    /** @var TranslationUpdater */
    private $translationUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        TranslationFactory $translationFactory,
        TranslationUpdater $translationUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->translationFactory = $translationFactory;
        $this->translationUpdater = $translationUpdater;
    }

    public function createTranslation(TranslationFormDataInterface $formData): TranslationInterface
    {
        $translation = $this->translationFactory->createFromFormData($formData);

        $this->entityManager->persist($translation);
        $this->entityManager->flush();

        return $translation;
    }

    public function updateTranslation(TranslationInterface $translation, TranslationFormDataInterface $formData): void
    {
        $this->translationUpdater->updateTranslation($translation, $formData);

        $this->entityManager->flush();
    }

    public function updateTranslationPositionInRussianWordDetail(TranslationInterface $translation, string $move): void
    {
        switch ($move) {
            case 'up':
                $translation->decreasePositionInRussianWordDetail();
                break;
            case 'down':
                $translation->increasePositionInRussianWordDetail();
                break;
            default:
                return;
        }

        $this->entityManager->flush();
    }

    public function updateTranslationPositionInCzechWordDetail(TranslationInterface $translation, string $move): void
    {
        switch ($move) {
            case 'up':
                $translation->decreasePositionInCzechWordDetail();
                break;
            case 'down':
                $translation->increasePositionInCzechWordDetail();
                break;
            default:
                return;
        }

        $this->entityManager->flush();
    }

    public function deleteTranslation(TranslationInterface $translation): void
    {
        $this->entityManager->remove($translation);
        $this->entityManager->flush();
    }
}

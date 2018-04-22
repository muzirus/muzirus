<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\TranslationInterface;
use App\Factory\TranslationFactory;
use App\Form\Translation\TranslationFormDataInterface;
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

    public function createTranslation(TranslationFormDataInterface $formData): TranslationInterface
    {
        $translation = $this->translationFactory->createFromFormData($formData);

        $this->entityManager->persist($translation);
        $this->entityManager->flush();

        return $translation;
    }

    public function updateTranslation(TranslationInterface $translation, TranslationFormDataInterface $formData): void
    {
        $translation->setRussianWord($formData->getRussianWord());
        $translation->setRussianWordNote($formData->getRussianWordNote());
        $translation->setCzechWord($formData->getCzechWord());
        $translation->setCzechWordNote($formData->getCzechWordNote());
        $translation->setLink($formData->getLink());

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

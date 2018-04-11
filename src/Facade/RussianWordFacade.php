<?php declare(strict_types=1);

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
        $word = $this->russianWordFactory->createFromFormData($formData);

        $this->entityManager->persist($word);
        $this->entityManager->flush();

        return $word;
    }

    public function updateWord(RussianWordInterface $word, RussianWordFormData $formData): void
    {
        $word->setContent($formData->getContent());

        $word->removeCategories();
        foreach ($formData->getCategories() as $category) {
            $word->addCategory($category);
        }

        $word->removeSources();
        foreach ($formData->getSources() as $source) {
            $word->addSource($source);
        }

        $word->setContentWithAccent($formData->getContentWithAccent());
        $word->setLanguageNotePronunciation($formData->getLanguageNotePronunciation());
        $word->setLanguageNoteInflection($formData->getLanguageNoteInflection());
        $word->setLanguageNoteExceptionToInflection($formData->getLanguageNoteExceptionToInflection());
        $word->setLanguageNoteType($formData->getLanguageNoteType());
        $word->setLanguageNoteGender($formData->getLanguageNoteGender());
        $word->setLanguageNoteOther($formData->getLanguageNoteOther());
        $word->setExplanation($formData->getExplanation());
        $word->setExplanationSourceInfo($formData->getExplanationSourceInfo());
        $word->setExplanationSourceDate($formData->getExplanationSourceDate());
        $word->setNote($formData->getNote());
        $word->setStatusLight($formData->getStatusLight());

        $this->entityManager->flush();
    }

    public function deleteWord(RussianWordInterface $word): void
    {
        $this->entityManager->remove($word);
        $this->entityManager->flush();
    }
}

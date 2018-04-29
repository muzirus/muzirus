<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\CzechWordInterface;
use App\Factory\CzechWordFactory;
use App\Form\Word\CzechWordFormData;
use Doctrine\ORM\EntityManagerInterface;

class CzechWordFacade
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var CzechWordFactory */
    private $czechWordFactory;

    public function __construct(EntityManagerInterface $entityManager, CzechWordFactory $czechWordFactory)
    {
        $this->entityManager = $entityManager;
        $this->czechWordFactory = $czechWordFactory;
    }

    public function createWord(CzechWordFormData $formData): CzechWordInterface
    {
        $word = $this->czechWordFactory->createFromFormData($formData);

        $this->entityManager->persist($word);
        $this->entityManager->flush();

        return $word;
    }

    public function updateWord(CzechWordInterface $word, CzechWordFormData $formData): void
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

    public function deleteWord(CzechWordInterface $word): void
    {
        $this->entityManager->remove($word);
        $this->entityManager->flush();
    }
}

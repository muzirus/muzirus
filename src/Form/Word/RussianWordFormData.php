<?php

namespace App\Form\Word;

use App\Entity\RussianWordInterface;

class RussianWordFormData extends AbstractWordFormData
{
    /**
     * @var string
     */
    private $contentWithAccent = '';

    //-------------------------------------------------------------------------

    public static function createFromWord(RussianWordInterface $word): self
    {
        $formData = new self();

        $formData->setContent($word->getContent());

        if (!empty($word->getContentWithAccent())) {
            $formData->setContentWithAccent($word->getContentWithAccent());
        } else {
            $formData->setContentWithAccent($word->getContent());
        }

        foreach ($word->getCategories() as $category) {
            $formData->categoryIds[] = $category->getId();
        }

        foreach ($word->getSources() as $source) {
            $formData->sourceIds[] = $source->getId();
        }

        $formData->setLanguageNotePronunciation($word->getLanguageNotePronunciation());
        $formData->setLanguageNoteInflection($word->getLanguageNoteInflection());
        $formData->setLanguageNoteExceptionToInflection($word->getLanguageNoteExceptionToInflection());
        $formData->setLanguageNoteGender($word->getLanguageNoteGender());
        $formData->setLanguageNoteOther($word->getLanguageNoteOther());
        $formData->setExplanation($word->getExplanation());
        $formData->setExplanationSourceInfo($word->getExplanationSourceInfo());
        $formData->setExplanationSourceDate($word->getExplanationSourceDate());
        $formData->setNote($word->getNote());
        $formData->setStatusLight($word->getStatusLight());

        return $formData;
    }

    //-------------------------------------------------------------------------

    public function getContentWithAccent(): string
    {
        return $this->contentWithAccent;
    }

    public function setContentWithAccent(string $contentWithAccent): void
    {
        $this->contentWithAccent = $contentWithAccent;
    }
}

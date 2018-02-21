<?php

namespace App\Form\Word;

use App\Entity\CzechWordInterface;

class CzechWordFormData extends AbstractWordFormData
{
    public static function createFromWord(CzechWordInterface $word): self
    {
        $formData = new self();

        $formData->setContent($word->getContent());

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
}

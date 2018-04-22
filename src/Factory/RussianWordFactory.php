<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\RussianWord;
use App\Entity\RussianWordInterface;
use App\Form\Word\RussianWordFormData;

class RussianWordFactory
{
    public function createFromFormData(RussianWordFormData $formData): RussianWordInterface
    {
        $word = new RussianWord($formData->getContent());

        foreach ($formData->getCategories() as $category) {
            $word->addCategory($category);
        }

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

        return $word;
    }
}

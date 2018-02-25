<?php

namespace App\Form\Word;

use App\Entity\AbstractWordInterface;
use App\Entity\Source;
use App\Entity\WordCategory;

abstract class AbstractWordFormData
{
    /**
     * @var string
     */
    protected $content = '';

    /**
     * @var WordCategory[]
     */
    protected $categories = [];

    /**
     * @var Source[]
     */
    protected $sources = [];

    /**
     * @var string
     */
    protected $languageNotePronunciation = '';

    /**
     * @var string
     */
    protected $languageNoteInflection = '';

    /**
     * @var string
     */
    protected $languageNoteExceptionToInflection = '';

    /**
     * @var int
     */
    protected $languageNoteGender = AbstractWordInterface::GENDER_UNKNOWN;

    /**
     * @var string
     */
    protected $languageNoteOther = '';

    /**
     * @var string
     */
    protected $explanation = '';

    /**
     * @var string
     */
    protected $explanationSourceInfo = '';

    /**
     * @var string
     */
    protected $explanationSourceDate = '';

    /**
     * @var string
     */
    protected $note = '';

    /**
     * @var int
     */
    protected $statusLight = AbstractWordInterface::STATUS_LIGHT_UNKNOWN;

    //-------------------------------------------------------------------------

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return WordCategory[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param WordCategory[] $categories
     */
    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return Source[]
     */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
     * @param Source[] $sources
     */
    public function setSources(array $sources): void
    {
        $this->sources = $sources;
    }

    public function getLanguageNotePronunciation(): string
    {
        return $this->languageNotePronunciation;
    }

    public function setLanguageNotePronunciation(string $languageNotePronunciation): void
    {
        $this->languageNotePronunciation = $languageNotePronunciation;
    }

    public function getLanguageNoteInflection(): string
    {
        return $this->languageNoteInflection;
    }

    public function setLanguageNoteInflection(string $languageNoteInflection): void
    {
        $this->languageNoteInflection = $languageNoteInflection;
    }

    public function getLanguageNoteExceptionToInflection(): string
    {
        return $this->languageNoteExceptionToInflection;
    }

    public function setLanguageNoteExceptionToInflection(string $languageNoteExceptionToInflection): void
    {
        $this->languageNoteExceptionToInflection = $languageNoteExceptionToInflection;
    }

    public function getLanguageNoteGender(): int
    {
        return $this->languageNoteGender;
    }

    public function setLanguageNoteGender(int $languageNoteGender): void
    {
        $this->languageNoteGender = $languageNoteGender;
    }

    public function getLanguageNoteOther(): string
    {
        return $this->languageNoteOther;
    }

    public function setLanguageNoteOther(string $languageNoteOther): void
    {
        $this->languageNoteOther = $languageNoteOther;
    }

    public function getExplanation(): string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): void
    {
        $this->explanation = $explanation;
    }

    public function getExplanationSourceInfo(): string
    {
        return $this->explanationSourceInfo;
    }

    public function setExplanationSourceInfo(string $explanationSourceInfo): void
    {
        $this->explanationSourceInfo = $explanationSourceInfo;
    }

    public function getExplanationSourceDate(): string
    {
        return $this->explanationSourceDate;
    }

    public function setExplanationSourceDate(string $explanationSourceDate): void
    {
        $this->explanationSourceDate = $explanationSourceDate;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getStatusLight(): int
    {
        return $this->statusLight;
    }

    public function setStatusLight(int $statusLight): void
    {
        $this->statusLight = $statusLight;
    }

    public function populate(AbstractWordInterface $word): void
    {
        $this->setContent($word->getContent());
        $this->setCategories($word->getCategories());
        $this->setSources($word->getSources());
        $this->setLanguageNotePronunciation($word->getLanguageNotePronunciation());
        $this->setLanguageNoteInflection($word->getLanguageNoteInflection());
        $this->setLanguageNoteExceptionToInflection($word->getLanguageNoteExceptionToInflection());
        $this->setLanguageNoteGender($word->getLanguageNoteGender());
        $this->setLanguageNoteOther($word->getLanguageNoteOther());
        $this->setExplanation($word->getExplanation());
        $this->setExplanationSourceInfo($word->getExplanationSourceInfo());
        $this->setExplanationSourceDate($word->getExplanationSourceDate());
        $this->setNote($word->getNote());
        $this->setStatusLight($word->getStatusLight());
    }
}

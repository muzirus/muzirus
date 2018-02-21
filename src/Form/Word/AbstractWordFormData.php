<?php

namespace App\Form\Word;

use App\Entity\AbstractWord;

abstract class AbstractWordFormData
{
    /**
     * @var string
     */
    protected $content = '';

    /**
     * @var array
     */
    protected $categoryIds = [];

    /**
     * @var array
     */
    protected $sourceIds = [];

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
    protected $languageNoteGender = AbstractWord::GENDER_UNKNOWN;

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
    protected $statusLight = AbstractWord::STATUS_LIGHT_UNKNOWN;

    //-------------------------------------------------------------------------

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCategoryIds(): array
    {
        return $this->categoryIds;
    }

    public function setCategoryIds(array $categoryIds): void
    {
        $this->categoryIds = $categoryIds;
    }

    public function getSourceIds(): array
    {
        return $this->sourceIds;
    }

    public function setSourceIds(array $sourceIds): void
    {
        $this->sourceIds = $sourceIds;
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
}

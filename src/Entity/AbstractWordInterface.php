<?php

namespace App\Entity;

use App\Entity\Able\Timestampable;

interface AbstractWordInterface extends Timestampable
{
    public function __toString(): string;

    public function getId(): int;

    public function getContent(): string;

    public function setContent(string $content): void;

    public function getContentWithAccent(): string;

    public function setContentWithAccent(string $contentWithAccent): void;

    public function getLanguageNotePronunciation(): string;

    public function setLanguageNotePronunciation(string $languageNotePronunciation): void;

    public function getLanguageNoteInflection(): string;

    public function setLanguageNoteInflection(string $languageNoteInflection): void;

    public function getLanguageNoteExceptionToInflection(): string;

    public function setLanguageNoteExceptionToInflection(string $languageNoteExceptionToInflection): void;

    public function getLanguageNoteGender(): int;

    public function setLanguageNoteGender(int $languageNoteGender): void;

    public function getLanguageNoteOther(): string;

    public function setLanguageNoteOther(string $languageNoteOther): void;

    public function getExplanation(): string;

    public function setExplanation(string $explanation): void;

    public function getExplanationSourceInfo(): string;

    public function setExplanationSourceInfo(string $explanationSourceInfo): void;

    public function getExplanationSourceDate(): string;

    public function setExplanationSourceDate(string $explanationSourceDate): void;

    public function getNote(): string;

    public function setNote(string $note): void;

    public function getStatusLight(): int;

    public function setStatusLight(int $statusLight): void;

    public function addSource(Source $source): void;

    public function removeSource(Source $source): void;

    /**
     * @return Source[]
     */
    public function getSources(): array;

    public function removeSources(): void;

    public function addCategory(WordCategory $category): void;

    public function removeCategory(WordCategory $category): void;

    /**
     * @return WordCategoryInterface[]
     */
    public function getCategories(): array;

    public function removeCategories(): void;

    /**
     * @return Translation[]
     */
    public function getTranslations(): array;

    public function getTranslationsCount(): int;

    public function isImported(): bool;

    public function setImported(bool $imported = true): void;
}

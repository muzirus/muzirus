<?php declare(strict_types=1);

namespace App\Form\Word;

use App\Entity\AbstractWordInterface;
use App\Entity\CategoryInterface;
use App\Entity\SourceInterface;

interface AbstractWordFormDataInterface
{
    public function getContent(): string;

    public function setContent(string $content): void;

    /**
     * @return CategoryInterface[]
     */
    public function getCategories(): array;

    /**
     * @param CategoryInterface[] $categories
     */
    public function setCategories(array $categories): void;

    /**
     * @return SourceInterface[]
     */
    public function getSources(): array;

    /**
     * @param SourceInterface[] $sources
     */
    public function setSources(array $sources): void;

    public function getLanguageNotePronunciation(): string;

    public function setLanguageNotePronunciation(string $languageNotePronunciation): void;

    public function getLanguageNoteInflection(): string;

    public function setLanguageNoteInflection(string $languageNoteInflection): void;

    public function getLanguageNoteExceptionToInflection(): string;

    public function setLanguageNoteExceptionToInflection(string $languageNoteExceptionToInflection): void;

    public function getLanguageNoteType(): int;

    public function setLanguageNoteType(int $languageNoteType): void;

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

    public function populate(AbstractWordInterface $word): void;
}

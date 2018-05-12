<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;

interface AbstractWordInterface extends TimestampableInterface
{
    public const TYPE_UNKNOWN = 0;
    public const TYPE_NOUN = 1;          // podstatná jména (Substantiva)
    public const TYPE_VERB = 2;          // slovesa (Verba)
    public const TYPE_ADJECTIVE = 3;     // přídavná jména (Adjektiva)
    public const TYPE_PRONOUN = 4;       // zájmena (Pronomina)
    public const TYPE_NUMERAL = 5;       // číslovky (Numeralia)
    public const TYPE_ADVERB = 6;        // příslovce (Adverbia)
    public const TYPE_PREPOSITION = 7;   // předložky (Prepozice)
    public const TYPE_CONJUNCTION = 8;   // spojky (Konjunkce)
    public const TYPE_PARTICLE = 9;      // částice (Partikule)
    public const TYPE_INTERJECTION = 10; // citoslovce (Interjekce)

    public const GENDER_UNKNOWN = 0;
    public const GENDER_MASCULINE = 1;
    public const GENDER_FEMININE = 2;
    public const GENDER_NEUTER = 3;

    public const STATUS_LIGHT_NOT_PROCESSED = 0;
    public const STATUS_LIGHT_EQUIVALENTS_NOT_FOUND = 1;
    public const STATUS_LIGHT_EXAMPLES_FOUND = 2;
    public const STATUS_LIGHT_CHECKED = 3;

    public function __toString(): string;

    public function getId(): string;

    public function getContent(): string;

    public function setContent(string $content): void;

    public function getContentWithAccent(): string;

    public function setContentWithAccent(string $contentWithAccent): void;

    public function hasLanguageNotePronunciation(): bool;

    public function getLanguageNotePronunciation(): string;

    public function setLanguageNotePronunciation(string $languageNotePronunciation): void;

    public function hasLanguageNoteInflection(): bool;

    public function getLanguageNoteInflection(): string;

    public function setLanguageNoteInflection(string $languageNoteInflection): void;

    public function hasLanguageNoteExceptionToInflection(): bool;

    public function getLanguageNoteExceptionToInflection(): string;

    public function setLanguageNoteExceptionToInflection(string $languageNoteExceptionToInflection): void;

    public function getLanguageNoteType(): int;

    public function setLanguageNoteType(int $languageNoteType): void;

    public function getLanguageNoteGender(): int;

    public function setLanguageNoteGender(int $languageNoteGender): void;

    public function hasLanguageNoteOther(): bool;

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

    public function addSource(SourceInterface $source): void;

    public function removeSource(SourceInterface $source): void;

    /**
     * @return SourceInterface[]
     */
    public function getSources(): array;

    public function removeSources(): void;

    public function addCategory(WordCategoryInterface $category): void;

    public function removeCategory(WordCategoryInterface $category): void;

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

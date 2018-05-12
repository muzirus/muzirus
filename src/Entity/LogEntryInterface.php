<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;

interface LogEntryInterface extends TimestampableInterface
{
    public function getId(): int;

    public function getName(): string;

    public function hasUser(): bool;

    public function getUser(): UserInterface;

    public function setRussianWord(RussianWordInterface $word): void;

    public function hasRussianWord(): bool;

    public function getRussianWord(): RussianWordInterface;

    public function setCzechWord(CzechWordInterface $word): void;

    public function hasCzechWord(): bool;

    public function getCzechWord(): CzechWordInterface;

    public function setCategory(WordCategoryInterface $category): void;

    public function hasCategory(): bool;

    public function getCategory(): WordCategoryInterface;

    public function setSource(SourceInterface $source): void;

    public function hasSource(): bool;

    public function getSource(): SourceInterface;

    public function setSourceType(SourceTypeInterface $sourceType): void;

    public function hasSourceType(): bool;

    public function getSourceType(): SourceTypeInterface;

    public function setTranslation(TranslationInterface $translation): void;

    public function hasTranslation(): bool;

    public function getTranslation(): TranslationInterface;

    public function setTranslationExample(TranslationExampleInterface $translationExample): void;

    public function hasTranslationExample(): bool;

    public function getTranslationExample(): TranslationExampleInterface;
}

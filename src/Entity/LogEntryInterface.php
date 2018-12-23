<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;

interface LogEntryInterface extends TimestampableInterface
{
    public function getId(): int;

    public function getName(): string;

    public function getUser(): ?UserInterface;

    public function setRussianWord(RussianWordInterface $word): void;

    public function getRussianWord(): ?RussianWordInterface;

    public function setCzechWord(CzechWordInterface $word): void;

    public function getCzechWord(): ?CzechWordInterface;

    public function setCategory(CategoryInterface $category): void;

    public function getCategory(): ?CategoryInterface;

    public function setSource(SourceInterface $source): void;

    public function getSource(): ?SourceInterface;

    public function setSourceType(SourceTypeInterface $sourceType): void;

    public function getSourceType(): ?SourceTypeInterface;

    public function setTranslation(TranslationInterface $translation): void;

    public function getTranslation(): ?TranslationInterface;

    public function setTranslationExample(TranslationExampleInterface $translationExample): void;

    public function getTranslationExample(): ?TranslationExampleInterface;
}

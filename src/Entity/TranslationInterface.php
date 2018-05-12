<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;

interface TranslationInterface extends TimestampableInterface
{
    public function __toString(): string;

    public function getId(): string;

    public function getRussianWord(): RussianWordInterface;

    public function setRussianWord(RussianWordInterface $russianWord): void;

    public function getRussianWordNote(): string;

    public function setRussianWordNote(string $russianWordNote): void;

    public function getCzechWord(): CzechWordInterface;

    public function setCzechWord(CzechWordInterface $czechWord): void;

    public function getCzechWordNote(): string;

    public function setCzechWordNote(string $czechWordNote): void;

    public function setLink(string $link): void;

    public function getLink(): string;

    public function getPositionInRussianWordDetail(): int;

    public function increasePositionInRussianWordDetail(): void;

    public function decreasePositionInRussianWordDetail(): void;

    public function getPositionInCzechWordDetail(): int;

    public function increasePositionInCzechWordDetail(): void;

    public function decreasePositionInCzechWordDetail(): void;

    /**
     * @return TranslationExampleInterface[]
     */
    public function getExamples(): array;

    public function getExamplesCount(): int;
}

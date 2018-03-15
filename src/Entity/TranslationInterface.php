<?php

namespace App\Entity;

use App\Entity\Able\Timestampable;

interface TranslationInterface extends Timestampable
{
    public function getId(): int;

    public function getRussianWord(): RussianWordInterface;

    public function setRussianWord(RussianWordInterface $russianWord): void;

    public function getRussianWordNote(): string;

    public function setRussianWordNote(string $russianWordNote): void;

    public function getCzechWord(): CzechWordInterface;

    public function setCzechWord(CzechWordInterface $czechWord): void;

    public function getCzechWordNote(): string;

    public function setCzechWordNote(string $czechWordNote): void;

    public function getPosition(): int;

    public function setPosition(int $position): void;

    /**
     * @return TranslationExampleInterface[]
     */
    public function getExamples(): array;

    public function getExamplesCount(): int;
}

<?php

namespace App\Entity;

use App\Entity\Able\Timestampable;

interface TranslationExampleInterface extends Timestampable
{
    public function __toString(): string;

    public function getId(): int;

    public function getTranslation(): TranslationInterface;

    public function getRussianWordSentence(): string;

    public function setRussianWordSentence(string $russianWordSentence): void;

    public function getCzechWordSentence(): string;

    public function setCzechWordSentence(string $czechWordSentence): void;
}

<?php

namespace App\Entity;

use App\Entity\Able\Approvable;
use App\Entity\Able\Refusable;
use App\Entity\Able\Timestampable;

interface TranslationExampleInterface extends Timestampable, Approvable, Refusable
{
    public function getId(): int;

    public function getTranslation(): TranslationInterface;

    public function getRussianWordSentence(): string;

    public function setRussianWordSentence(string $russianWordSentence): void;

    public function getCzechWordSentence(): string;

    public function setCzechWordSentence(string $czechWordSentence): void;
}

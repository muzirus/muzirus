<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\Hideable;
use App\Entity\Able\Timestampable;

interface TranslationExampleInterface extends Timestampable, Hideable
{
    public function __toString(): string;

    public function getId(): int;

    public function getTranslation(): TranslationInterface;

    public function getRussianWordSentence(): string;

    public function setRussianWordSentence(string $russianWordSentence): void;

    public function getCzechWordSentence(): string;

    public function setCzechWordSentence(string $czechWordSentence): void;
}

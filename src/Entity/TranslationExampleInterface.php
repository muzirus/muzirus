<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\HideableInterface;
use App\Entity\Able\TimestampableInterface;

interface TranslationExampleInterface extends TimestampableInterface, HideableInterface
{
    public function __toString(): string;

    public function getId(): string;

    public function getTranslation(): TranslationInterface;

    public function getRussianWordSentence(): string;

    public function setRussianWordSentence(string $russianWordSentence): void;

    public function getCzechWordSentence(): string;

    public function setCzechWordSentence(string $czechWordSentence): void;
}

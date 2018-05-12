<?php declare(strict_types=1);

namespace App\Form\TranslationExample;

use App\Entity\TranslationInterface;

interface TranslationExampleFormDataInterface
{
    public function getTranslation(): TranslationInterface;

    public function getCzechWordSentence(): string;

    public function setCzechWordSentence(string $czechWordSentence): void;

    public function getRussianWordSentence(): string;

    public function setRussianWordSentence(string $russianWordSentence): void;

    public function isHidden(): bool;

    public function setHidden(bool $hidden): void;
}

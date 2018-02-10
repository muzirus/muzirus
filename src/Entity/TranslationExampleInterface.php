<?php

namespace App\Entity;

use App\Entity\Able\Approvable;
use App\Entity\Able\Refusable;
use App\Entity\Able\Timestampable;

interface TranslationExampleInterface extends Timestampable, Approvable, Refusable
{
    public function getTranslation(): Translation;

    public function setTranslation(Translation $translation): void;

    public function getFirstWordSentence(): string;

    public function setFirstWordSentence(string $russianWordSentence): void;

    public function getSecondWordSentence(): string;

    public function setSecondWordSentence(string $czechWordSentence): void;
}

<?php

namespace App\Form\Translation;

use App\Entity\CzechWordInterface;
use App\Entity\RussianWordInterface;

interface TranslationFormDataInterface
{
    public function getRussianWord(): ?RussianWordInterface;

    public function setRussianWord(?RussianWordInterface $russianWord): void;

    public function getRussianWordNote(): string;

    public function setRussianWordNote(string $russianWordNote);

    public function getCzechWord(): ?CzechWordInterface;

    public function setCzechWord(?CzechWordInterface $czechWord);

    public function getCzechWordNote(): string;

    public function setCzechWordNote(string $czechWordNote);
}

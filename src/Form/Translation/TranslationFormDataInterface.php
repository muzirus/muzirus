<?php

namespace App\Form\Translation;

use App\Entity\CzechWordInterface;
use App\Entity\RussianWordInterface;

interface TranslationFormDataInterface
{
    public function getRussianWord(): ?RussianWordInterface;

    public function setRussianWord(?RussianWordInterface $russianWord): void;

    public function getRussianWordNote(): string;

    public function setRussianWordNote(string $russianWordNote): void;

    public function getCzechWord(): ?CzechWordInterface;

    public function setCzechWord(?CzechWordInterface $czechWord): void;

    public function getCzechWordNote(): string;

    public function setCzechWordNote(string $czechWordNote): void;

    public function getLink(): string;

    public function setLink(string $link): void;
}

<?php

namespace App\Form\Translation;

use App\Entity\CzechWordInterface;
use App\Entity\RussianWordInterface;

interface CreateTranslationFormDataInterface extends UpdateTranslationFormDataInterface
{
    public function getRussianWord(): ?RussianWordInterface;

    public function getCzechWord(): ?CzechWordInterface;
}

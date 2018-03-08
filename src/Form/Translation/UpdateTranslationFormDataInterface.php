<?php

namespace App\Form\Translation;

interface UpdateTranslationFormDataInterface
{
    public function getRussianWordNote(): string;

    public function getCzechWordNote(): string;
}

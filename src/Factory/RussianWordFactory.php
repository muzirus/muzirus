<?php

namespace App\Factory;

use App\Entity\RussianWord;
use App\Entity\RussianWordInterface;
use App\Form\Word\RussianWordFormData;

class RussianWordFactory
{
    public function createFromFormData(RussianWordFormData $formData): RussianWordInterface
    {
        $russianWord = new RussianWord($formData->getContent());

        // todo: add other things

        return $russianWord;
    }
}

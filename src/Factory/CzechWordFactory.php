<?php

namespace App\Factory;

use App\Entity\CzechWord;
use App\Entity\CzechWordInterface;
use App\Form\Word\CzechWordFormData;

class CzechWordFactory
{
    public function createFromFormData(CzechWordFormData $formData): CzechWordInterface
    {
        $czechWord = new CzechWord($formData->getContent());

        // todo: add other things

        return $czechWord;
    }
}

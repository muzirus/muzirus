<?php

namespace App\Form\Word;

use App\Entity\CzechWordInterface;

class CzechWordFormData extends AbstractWordFormData
{
    public static function createFromWord(CzechWordInterface $word): self
    {
        $formData = new self();

        $formData->populate($word);

        return $formData;
    }
}

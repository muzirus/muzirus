<?php declare(strict_types=1);

namespace App\Form\Word;

use App\Entity\CzechWordInterface;

class CzechWordFormData extends AbstractWordFormData implements CzechWordFormDataInterface
{
    public static function fromWord(CzechWordInterface $word): self
    {
        $formData = new self();

        $formData->populate($word);

        return $formData;
    }
}

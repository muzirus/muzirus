<?php

namespace App\Form\Word;

use App\Entity\RussianWordInterface;

class RussianWordFormData extends AbstractWordFormData
{
    /**
     * @var string
     */
    private $contentWithAccent = '';

    //-------------------------------------------------------------------------

    public static function createFromWord(RussianWordInterface $word): self
    {
        $formData = new self();

        $formData->populate($word);

        if (!empty($word->getContentWithAccent())) {
            $formData->setContentWithAccent($word->getContentWithAccent());
        } else {
            $formData->setContentWithAccent($word->getContent());
        }

        return $formData;
    }

    //-------------------------------------------------------------------------

    public function getContentWithAccent(): string
    {
        return $this->contentWithAccent;
    }

    public function setContentWithAccent(string $contentWithAccent): void
    {
        $this->contentWithAccent = $contentWithAccent;
    }
}

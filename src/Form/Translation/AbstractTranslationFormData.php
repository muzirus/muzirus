<?php

namespace App\Form\Translation;

use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractTranslationFormData
{
    /**
     * @var string
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private $russianWordNote = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $czechWordNote = '';

    public function getRussianWordNote(): string
    {
        return $this->russianWordNote;
    }

    public function setRussianWordNote(string $russianWordNote): void
    {
        $this->russianWordNote = $russianWordNote;
    }

    public function getCzechWordNote(): string
    {
        return $this->czechWordNote;
    }

    public function setCzechWordNote(string $czechWordNote): void
    {
        $this->czechWordNote = $czechWordNote;
    }
}

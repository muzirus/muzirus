<?php

namespace App\Form\Translation;

class TranslationFormData
{
    /**
     * @var int
     */
    private $russianWordId = 0;

    /**
     * @var int
     */
    private $czechWordId = 0;

    /**
     * @var string
     */
    private $russianWordNote = '';

    /**
     * @var string
     */
    private $czechWordNote = '';

    public function getRussianWordId(): int
    {
        return $this->russianWordId;
    }

    public function setRussianWordId(int $russianWordId): void
    {
        $this->russianWordId = $russianWordId;
    }

    public function getCzechWordId(): int
    {
        return $this->czechWordId;
    }

    public function setCzechWordId(int $czechWordId): void
    {
        $this->czechWordId = $czechWordId;
    }

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

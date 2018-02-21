<?php

namespace App\Form\Translation;

class TranslationFormData
{
    /**
     * @var string
     */
    private $noteRussian = '';

    /**
     * @var string
     */
    private $noteCzech = '';

    public function getNoteRussian(): string
    {
        return $this->noteRussian;
    }

    public function setNoteRussian(string $noteRussian): void
    {
        $this->noteRussian = $noteRussian;
    }

    public function getNoteCzech(): string
    {
        return $this->noteCzech;
    }

    public function setNoteCzech(string $noteCzech): void
    {
        $this->noteCzech = $noteCzech;
    }
}

<?php

namespace App\Form\TranslationExample;

class TranslationExampleFormData
{
    /**
     * @var string
     */
    private $czechWordSentence = '';

    /**
     * @var string
     */
    private $russianWordSentence = '';

    //-------------------------------------------------------------------------

    public function getCzechWordSentence(): string
    {
        return $this->czechWordSentence;
    }

    public function setCzechWordSentence(string $czechWordSentence): void
    {
        $this->czechWordSentence = $czechWordSentence;
    }

    public function getRussianWordSentence(): string
    {
        return $this->russianWordSentence;
    }

    public function setRussianWordSentence(string $russianWordSentence): void
    {
        $this->russianWordSentence = $russianWordSentence;
    }
}

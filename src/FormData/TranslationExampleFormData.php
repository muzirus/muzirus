<?php

namespace App\FormData;

class TranslationExampleFormData
{
    /**
     * @var string
     */
    private $sentenceOne = '';

    /**
     * @var string
     */
    private $sentenceTwo = '';

    //-------------------------------------------------------------------------

    public function getSentenceOne(): string
    {
        return $this->sentenceOne;
    }

    public function setSentenceOne(string $sentenceOne): void
    {
        $this->sentenceOne = $sentenceOne;
    }

    public function getSentenceTwo(): string
    {
        return $this->sentenceTwo;
    }

    public function setSentenceTwo(string $sentenceTwo): void
    {
        $this->sentenceTwo = $sentenceTwo;
    }
}

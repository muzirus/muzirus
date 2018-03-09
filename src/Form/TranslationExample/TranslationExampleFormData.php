<?php

namespace App\Form\TranslationExample;

use App\Entity\TranslationExampleInterface;
use App\Entity\TranslationInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TranslationExampleFormData
{

    /**
     * @var TranslationInterface
     */
    private $translation;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $czechWordSentence = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $russianWordSentence = '';

    //-------------------------------------------------------------------------

    public function __construct(TranslationInterface $translation)
    {
        $this->translation = $translation;
    }

    //-------------------------------------------------------------------------

    public function getTranslation(): TranslationInterface
    {
        return $this->translation;
    }

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

    //-------------------------------------------------------------------------

    public static function fromTranslationExample(TranslationExampleInterface $translationExample): self
    {
        $formData = new self($translationExample->getTranslation());

        $formData->setCzechWordSentence($translationExample->getCzechWordSentence());
        $formData->setRussianWordSentence($translationExample->getRussianWordSentence());

        return $formData;
    }
}

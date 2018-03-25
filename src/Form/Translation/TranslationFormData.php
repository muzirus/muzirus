<?php

namespace App\Form\Translation;

use App\Entity\CzechWordInterface;
use App\Entity\RussianWordInterface;
use App\Entity\TranslationInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TranslationFormData implements TranslationFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("object")
     * @var RussianWordInterface|null
     */
    private $russianWord;

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $russianWordNote = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Type("object")
     * @var CzechWordInterface|null
     */
    private $czechWord;

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $czechWordNote = '';

    //-------------------------------------------------------------------------

    public function getRussianWord(): ?RussianWordInterface
    {
        return $this->russianWord;
    }

    public function setRussianWord(?RussianWordInterface $russianWord): void
    {
        $this->russianWord = $russianWord;
    }

    public function getRussianWordNote(): string
    {
        return $this->russianWordNote;
    }

    public function setRussianWordNote(string $russianWordNote)
    {
        $this->russianWordNote = $russianWordNote;
    }

    public function getCzechWord(): ?CzechWordInterface
    {
        return $this->czechWord;
    }

    public function setCzechWord(?CzechWordInterface $czechWord)
    {
        $this->czechWord = $czechWord;
    }

    public function getCzechWordNote(): string
    {
        return $this->czechWordNote;
    }

    public function setCzechWordNote(string $czechWordNote)
    {
        $this->czechWordNote = $czechWordNote;
    }

    //-------------------------------------------------------------------------

    public static function createFromCzechWord(CzechWordInterface $word): self
    {
        $formData = new static();
        $formData->setCzechWord($word);

        return $formData;
    }

    public static function createFromRussianWord(RussianWordInterface $word): self
    {
        $formData = new static();
        $formData->setRussianWord($word);

        return $formData;
    }

    public static function createFromTranslation(TranslationInterface $translation): self
    {
        $formData = new static();
        $formData->setRussianWord($translation->getRussianWord());
        $formData->setRussianWordNote($translation->getRussianWordNote());
        $formData->setCzechWord($translation->getCzechWord());
        $formData->setCzechWordNote($translation->getCzechWordNote());

        return $formData;
    }
}

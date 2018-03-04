<?php

namespace App\Form\Translation;

use App\Entity\CzechWordInterface;
use App\Entity\RussianWordInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateRussianTranslationFormData extends AbstractTranslationFormData implements CreateTranslationFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("object")
     * @var CzechWordInterface
     */
    private $czechWord;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("object")
     * @var RussianWordInterface
     */
    private $russianWord;

    public function __construct(CzechWordInterface $czechWord)
    {
        $this->czechWord = $czechWord;
    }

    public function getCzechWord(): CzechWordInterface
    {
        return $this->czechWord;
    }

    public function getRussianWord(): ?RussianWordInterface
    {
        return $this->russianWord;
    }

    public function setRussianWord(RussianWordInterface $russianWord): void
    {
        $this->russianWord = $russianWord;
    }
}

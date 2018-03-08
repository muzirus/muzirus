<?php

namespace App\Form\Translation;

use App\Entity\CzechWordInterface;
use App\Entity\RussianWordInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateCzechTranslationFormData extends AbstractTranslationFormData implements CreateTranslationFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("object")
     * @var RussianWordInterface
     */
    private $russianWord;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("object")
     * @var CzechWordInterface
     */
    private $czechWord;

    public function __construct(RussianWordInterface $russianWord)
    {
        $this->russianWord = $russianWord;
    }

    public function getRussianWord(): RussianWordInterface
    {
        return $this->russianWord;
    }

    public function getCzechWord(): ?CzechWordInterface
    {
        return $this->czechWord;
    }

    public function setCzechWord(CzechWordInterface $czechWord): void
    {
        $this->czechWord = $czechWord;
    }
}

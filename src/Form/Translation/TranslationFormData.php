<?php declare(strict_types=1);

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
     */
    private ?RussianWordInterface $russianWord = null;

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $russianWordNote = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Type("object")
     */
    private ?CzechWordInterface $czechWord = null;

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $czechWordNote = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $link = '';

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

    public function setRussianWordNote(string $russianWordNote): void
    {
        $this->russianWordNote = $russianWordNote;
    }

    public function getCzechWord(): ?CzechWordInterface
    {
        return $this->czechWord;
    }

    public function setCzechWord(?CzechWordInterface $czechWord): void
    {
        $this->czechWord = $czechWord;
    }

    public function getCzechWordNote(): string
    {
        return $this->czechWordNote;
    }

    public function setCzechWordNote(string $czechWordNote): void
    {
        $this->czechWordNote = $czechWordNote;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    //-------------------------------------------------------------------------

    public static function fromCzechWord(CzechWordInterface $word): self
    {
        $formData = new self();
        $formData->setCzechWord($word);

        return $formData;
    }

    public static function fromRussianWord(RussianWordInterface $word): self
    {
        $formData = new self();
        $formData->setRussianWord($word);

        return $formData;
    }

    public static function fromTranslation(TranslationInterface $translation): self
    {
        $formData = new self();
        $formData->setRussianWord($translation->getRussianWord());
        $formData->setRussianWordNote($translation->getRussianWordNote());
        $formData->setCzechWord($translation->getCzechWord());
        $formData->setCzechWordNote($translation->getCzechWordNote());
        $formData->setLink($translation->getLink());

        return $formData;
    }
}

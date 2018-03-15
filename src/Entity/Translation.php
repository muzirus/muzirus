<?php

namespace App\Entity;

use App\EntityTrait\Timestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationRepository")
 * @ORM\Table(name="translations")
 * @ORM\HasLifecycleCallbacks()
 */
class Translation implements TranslationInterface
{
    use Timestamps;

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     * @var int
     */
    private $id;

    /**
     * Owning side.
     * @ORM\ManyToOne(targetEntity="RussianWord", inversedBy="translations")
     * @ORM\JoinColumn(name="first_word_id", referencedColumnName="id", nullable=false)
     * @var RussianWord
     */
    private $russianWord;

    /**
     * @ORM\Column(type="string", name="russian_word_note")
     * @var string
     */
    private $russianWordNote = '';

    /**
     * Owning side.
     * @ORM\ManyToOne(targetEntity="CzechWord", inversedBy="translations")
     * @ORM\JoinColumn(name="second_word_id", referencedColumnName="id", nullable=false)
     * @var CzechWord
     */
    private $czechWord;

    /**
     * @ORM\Column(type="string", name="czech_word_note")
     * @var string
     */
    private $czechWordNote = '';

    /**
     * @ORM\Column(type="integer", name="position", options={"default":0})
     * @var int
     */
    private $position = 0;

    /**
     * Inverse side.
     * @ORM\OneToMany(targetEntity="TranslationExample", mappedBy="translation")
     * @var ArrayCollection
     */
    private $translationExamples;

    //-------------------------------------------------------------------------

    public function __construct(RussianWordInterface $russianWord, CzechWordInterface $czechWord)
    {
        $this->russianWord = $russianWord;
        $this->czechWord = $czechWord;
        $this->translationExamples = new ArrayCollection();
    }

    //-------------------------------------------------------------------------

    public function getId(): int
    {
        return $this->id;
    }

    public function getRussianWord(): RussianWordInterface
    {
        return $this->russianWord;
    }

    public function setRussianWord(RussianWordInterface $russianWord): void
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

    public function getCzechWord(): CzechWordInterface
    {
        return $this->czechWord;
    }

    public function setCzechWord(CzechWordInterface $czechWord): void
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

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    /**
     * @return TranslationExampleInterface[]
     */
    public function getExamples(): array
    {
        return $this->translationExamples->toArray();
    }

    public function getExamplesCount(): int
    {
        return $this->translationExamples->count();
    }
}

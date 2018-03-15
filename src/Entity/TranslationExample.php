<?php

namespace App\Entity;

use App\EntityTrait\Timestamps;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationExampleRepository")
 * @ORM\Table(name="translation_examples")
 * @ORM\HasLifecycleCallbacks()
 */
class TranslationExample implements TranslationExampleInterface
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
     * @ORM\ManyToOne(targetEntity="Translation", inversedBy="translationExamples")
     * @ORM\JoinColumn(name="translation_id", referencedColumnName="id", onDelete="cascade")
     * @var Translation
     */
    private $translation;

    /**
     * @ORM\Column(type="string", name="first_word_sentence")
     * @var string
     */
    private $russianWordSentence = '';

    /**
     * @ORM\Column(type="string", name="second_word_sentence")
     * @var string
     */
    private $czechWordSentence = '';

    //-------------------------------------------------------------------------

    public function __construct(
        TranslationInterface $translation,
        string $russianWordSentence,
        string $czechWordSentence
    ) {
        $this->translation = $translation;
        $this->russianWordSentence = $russianWordSentence;
        $this->czechWordSentence = $czechWordSentence;
    }

    //-------------------------------------------------------------------------

    public function getId(): int
    {
        return $this->id;
    }

    public function getTranslation(): TranslationInterface
    {
        return $this->translation;
    }

    public function getRussianWordSentence(): string
    {
        return $this->russianWordSentence;
    }

    public function setRussianWordSentence(string $russianWordSentence): void
    {
        $this->russianWordSentence = $russianWordSentence;
    }

    public function getCzechWordSentence(): string
    {
        return $this->czechWordSentence;
    }

    public function setCzechWordSentence(string $czechWordSentence): void
    {
        $this->czechWordSentence = $czechWordSentence;
    }
}

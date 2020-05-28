<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationExampleRepository")
 * @ORM\Table(name="translation_examples")
 * @ORM\HasLifecycleCallbacks()
 */
class TranslationExample implements TranslationExampleInterface
{
    use TimestampsTrait;

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     */
    private string $id;

    /**
     * Owning side.
     *
     * @ORM\ManyToOne(targetEntity="Translation", inversedBy="translationExamples")
     * @ORM\JoinColumn(name="translation_id", referencedColumnName="id", onDelete="cascade")
     */
    private TranslationInterface $translation;

    /**
     * @ORM\Column(type="string", name="first_word_sentence")
     */
    private string $russianWordSentence;

    /**
     * @ORM\Column(type="string", name="second_word_sentence")
     */
    private string $czechWordSentence;

    /**
     * @ORM\Column(type="boolean", name="hidden", options={"default":false})
     */
    private bool $hidden;

    //-------------------------------------------------------------------------

    public function __construct(
        TranslationInterface $translation,
        string $russianWordSentence,
        string $czechWordSentence,
        bool $hidden
    ) {
        $this->translation = $translation;
        $this->russianWordSentence = $russianWordSentence;
        $this->czechWordSentence = $czechWordSentence;
        $this->hidden = $hidden;
    }

    public function __toString(): string
    {
        return sprintf('%s - %s', $this->russianWordSentence, $this->czechWordSentence);
    }

    //-------------------------------------------------------------------------

    public function getId(): string
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

    public function markHidden(): void
    {
        $this->hidden = true;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function markVisible(): void
    {
        $this->hidden = false;
    }

    public function isVisible(): bool
    {
        return !$this->hidden;
    }
}

<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationRepository")
 * @ORM\Table(name="translations")
 * @ORM\HasLifecycleCallbacks()
 */
class Translation implements TranslationInterface
{
    use TimestampsTrait;

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     * @var string
     */
    private $id;

    /**
     * Owning side.
     *
     * @ORM\ManyToOne(targetEntity="RussianWord", inversedBy="translations")
     * @ORM\JoinColumn(name="first_word_id", referencedColumnName="id", nullable=false)
     * @var RussianWordInterface
     */
    private $russianWord;

    /**
     * @ORM\Column(type="string", name="russian_word_note")
     * @var string
     */
    private $russianWordNote = '';

    /**
     * Owning side.
     *
     * @ORM\ManyToOne(targetEntity="CzechWord", inversedBy="translations")
     * @ORM\JoinColumn(name="second_word_id", referencedColumnName="id", nullable=false)
     * @var CzechWordInterface
     */
    private $czechWord;

    /**
     * @ORM\Column(type="string", name="czech_word_note")
     * @var string
     */
    private $czechWordNote = '';

    /**
     * @ORM\Column(type="string", name="link")
     * @var string
     */
    private $link = '';

    /**
     * @ORM\Column(type="integer", name="position", options={"default":0})
     * @var int
     */
    private $positionInRussianWordDetail = 0;

    /**
     * @ORM\Column(type="integer", name="position_in_czech_word_detail", options={"default":0})
     * @var int
     */
    private $positionInCzechWordDetail = 0;

    /**
     * Inverse side.
     *
     * @ORM\OneToMany(targetEntity="TranslationExample", mappedBy="translation")
     * @var ArrayCollection|TranslationExample[]
     */
    private $translationExamples;

    //-------------------------------------------------------------------------

    public function __construct(RussianWordInterface $russianWord, CzechWordInterface $czechWord)
    {
        $this->russianWord = $russianWord;
        $this->czechWord = $czechWord;
        $this->translationExamples = new ArrayCollection();
    }

    public function __toString(): string
    {
        return sprintf('%s - %s', $this->getRussianWord(), $this->getCzechWord());
    }

    //-------------------------------------------------------------------------

    public function getId(): string
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

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function getPositionInRussianWordDetail(): int
    {
        return $this->positionInRussianWordDetail;
    }

    public function increasePositionInRussianWordDetail(): void
    {
        $this->positionInRussianWordDetail++;
    }

    public function decreasePositionInRussianWordDetail(): void
    {
        if ($this->positionInRussianWordDetail === 0) {
            return;
        }

        $this->positionInRussianWordDetail--;
    }

    public function getPositionInCzechWordDetail(): int
    {
        return $this->positionInCzechWordDetail;
    }

    public function increasePositionInCzechWordDetail(): void
    {
        $this->positionInCzechWordDetail++;
    }

    public function decreasePositionInCzechWordDetail(): void
    {
        if ($this->positionInCzechWordDetail === 0) {
            return;
        }

        $this->positionInCzechWordDetail--;
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

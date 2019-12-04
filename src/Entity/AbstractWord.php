<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\MappedSuperclass()
 * @ORM\Table(name="words", indexes={@ORM\Index(name="content_idx", columns={"content"})})
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="language", type="string")
 * @ORM\DiscriminatorMap({
 *   "czech" = "CzechWord",
 *   "russian" = "RussianWord",
 * })
 * @ORM\HasLifecycleCallbacks()
 */
abstract class AbstractWord implements AbstractWordInterface
{
    use TimestampsTrait;

    //-------------------------------------------------------------------------

    public const TYPES = [
        self::TYPE_UNKNOWN,
        self::TYPE_NOUN,
        self::TYPE_VERB,
        self::TYPE_ADJECTIVE,
        self::TYPE_PRONOUN,
        self::TYPE_NUMERAL,
        self::TYPE_ADVERB,
        self::TYPE_PREPOSITION,
        self::TYPE_CONJUNCTION,
        self::TYPE_PARTICLE,
        self::TYPE_INTERJECTION,
    ];

    public const GENDERS = [
        self::GENDER_UNKNOWN,
        self::GENDER_MASCULINE,
        self::GENDER_FEMININE,
        self::GENDER_NEUTER,
    ];

    public const STATUS_LIGHTS = [
        self::STATUS_LIGHT_NOT_PROCESSED,
        self::STATUS_LIGHT_EQUIVALENTS_NOT_FOUND,
        self::STATUS_LIGHT_EXAMPLES_FOUND,
        self::STATUS_LIGHT_CHECKED,
    ];

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     * @var string
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="content")
     * @var string
     */
    protected $content = '';

    /**
     * @ORM\Column(type="string", name="content_with_accent")
     * @var string
     */
    protected $contentWithAccent = '';

    /**
     * @ORM\Column(type="string", name="language_note_pronunciation")
     * @var string
     */
    protected $languageNotePronunciation = '';

    /**
     * @ORM\Column(type="string", name="language_note_inflection")
     * @var string
     */
    protected $languageNoteInflection = '';

    /**
     * @ORM\Column(type="string", name="language_note_exception_to_inflection")
     * @var string
     */
    protected $languageNoteExceptionToInflection = '';

    /**
     * @ORM\Column(type="integer", name="language_note_type", options={"default":0})
     * @var int
     */
    protected $languageNoteType = self::TYPE_UNKNOWN;

    /**
     * @ORM\Column(type="integer", name="language_note_gender", options={"default":0})
     * @var int
     */
    protected $languageNoteGender = self::GENDER_UNKNOWN;

    /**
     * @ORM\Column(type="text", name="language_note_other")
     * @var string
     */
    protected $languageNoteOther = '';

    /**
     * @ORM\Column(type="text", name="explanation")
     * @var string
     */
    protected $explanation = '';

    /**
     * @ORM\Column(type="string", name="explanation_source_info")
     * @var string
     */
    protected $explanationSourceInfo = '';

    /**
     * @ORM\Column(type="string", name="explanation_source_date")
     * @var string
     */
    protected $explanationSourceDate = '';

    /**
     * @ORM\Column(type="text", name="note")
     * @var string
     */
    protected $note = '';

    /**
     * @ORM\Column(type="integer", name="status_light", options={"default":0})
     * @var int
     */
    protected $statusLight = self::STATUS_LIGHT_NOT_PROCESSED;

    /**
     * @ORM\Column(type="boolean", name="imported", options={"default":false})
     * @var bool
     */
    protected $imported = false;

    /**
     * Owning side.
     *
     * @ORM\ManyToMany(targetEntity="Category")
     * @ORM\JoinTable(name="words_categories",
     *     joinColumns={@ORM\JoinColumn(name="word_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Category[]
     */
    protected $categories;

    /**
     * Owning side.
     *
     * @ORM\ManyToMany(targetEntity="Source")
     * @ORM\JoinTable(name="words_sources",
     *     joinColumns={@ORM\JoinColumn(name="word_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="source_id", referencedColumnName="id", onDelete="CASCADE")}
     * )
     * @var ArrayCollection|Source[]
     */
    protected $sources;

    /**
     * @var ArrayCollection|Translation[]
     */
    protected $translations;

    //-------------------------------------------------------------------------

    public function __construct(string $content)
    {
        $this->setContent($content);
        $this->categories = new ArrayCollection();
        $this->sources = new ArrayCollection();
        $this->translations = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->getContent();
    }

    //-------------------------------------------------------------------------

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContentWithAccent(): string
    {
        return $this->contentWithAccent;
    }

    public function setContentWithAccent(string $contentWithAccent): void
    {
        $this->contentWithAccent = $contentWithAccent;
    }

    public function hasLanguageNotePronunciation(): bool
    {
        return mb_strlen($this->languageNotePronunciation) > 0;
    }

    public function getLanguageNotePronunciation(): string
    {
        return $this->languageNotePronunciation;
    }

    public function setLanguageNotePronunciation(string $languageNotePronunciation): void
    {
        $this->languageNotePronunciation = $languageNotePronunciation;
    }

    public function hasLanguageNoteInflection(): bool
    {
        return mb_strlen($this->languageNoteInflection) > 0;
    }

    public function getLanguageNoteInflection(): string
    {
        return $this->languageNoteInflection;
    }

    public function setLanguageNoteInflection(string $languageNoteInflection): void
    {
        $this->languageNoteInflection = $languageNoteInflection;
    }

    public function hasLanguageNoteExceptionToInflection(): bool
    {
        return mb_strlen($this->languageNoteExceptionToInflection) > 0;
    }

    public function getLanguageNoteExceptionToInflection(): string
    {
        return $this->languageNoteExceptionToInflection;
    }

    public function setLanguageNoteExceptionToInflection(string $languageNoteExceptionToInflection): void
    {
        $this->languageNoteExceptionToInflection = $languageNoteExceptionToInflection;
    }

    public function getLanguageNoteType(): int
    {
        return $this->languageNoteType;
    }

    public function setLanguageNoteType(int $languageNoteType): void
    {
        if (array_key_exists($languageNoteType, self::TYPES)) {
            $this->languageNoteType = $languageNoteType;
        }
    }

    public function getLanguageNoteGender(): int
    {
        return $this->languageNoteGender;
    }

    public function setLanguageNoteGender(int $languageNoteGender): void
    {
        if (array_key_exists($languageNoteGender, self::GENDERS)) {
            $this->languageNoteGender = $languageNoteGender;
        }
    }

    public function hasLanguageNoteOther(): bool
    {
        return mb_strlen($this->languageNoteOther) > 0;
    }

    public function getLanguageNoteOther(): string
    {
        return $this->languageNoteOther;
    }

    public function setLanguageNoteOther(string $languageNoteOther): void
    {
        $this->languageNoteOther = $languageNoteOther;
    }

    public function getExplanation(): string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): void
    {
        $this->explanation = $explanation;
    }

    public function getExplanationSourceInfo(): string
    {
        return $this->explanationSourceInfo;
    }

    public function setExplanationSourceInfo(string $explanationSourceInfo): void
    {
        $this->explanationSourceInfo = $explanationSourceInfo;
    }

    public function getExplanationSourceDate(): string
    {
        return $this->explanationSourceDate;
    }

    public function setExplanationSourceDate(string $explanationSourceDate): void
    {
        $this->explanationSourceDate = $explanationSourceDate;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getStatusLight(): int
    {
        return $this->statusLight;
    }

    public function setStatusLight(int $statusLight): void
    {
        if (array_key_exists($statusLight, self::STATUS_LIGHTS)) {
            $this->statusLight = $statusLight;
        }
    }

    public function addSource(SourceInterface $source): void
    {
        if (!$this->sources->contains($source)) {
            $this->sources->add($source);
        }
    }

    public function removeSource(SourceInterface $source): void
    {
        if ($this->sources->contains($source)) {
            $this->sources->removeElement($source);
        }
    }

    /**
     * @return SourceInterface[]
     */
    public function getSources(): array
    {
        return $this->sources->toArray();
    }

    public function removeSources(): void
    {
        $this->sources->clear();
    }

    public function addCategory(CategoryInterface $category): void
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }
    }

    public function removeCategory(CategoryInterface $category): void
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }
    }

    /**
     * @return CategoryInterface[]
     */
    public function getCategories(): array
    {
        return $this->categories->toArray();
    }

    public function removeCategories(): void
    {
        $this->categories->clear();
    }

    /**
     * @return TranslationInterface[]
     */
    public function getTranslations(): array
    {
        return $this->translations->toArray();
    }

    public function getTranslationsCount(): int
    {
        return $this->translations->count();
    }

    public function isImported(): bool
    {
        return $this->imported;
    }

    public function setImported(bool $imported = true): void
    {
        $this->imported = $imported;
    }
}

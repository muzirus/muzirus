<?php

namespace App\Entity;

use App\EntityTrait\Timestamps;
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
    use Timestamps;

    //-------------------------------------------------------------------------

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
     * @var int
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
     * @ORM\Column(type="integer", name="language_note_gender")
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
     * @ORM\Column(type="integer", name="status_light")
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
     * @ORM\ManyToMany(targetEntity="WordCategory")
     * @ORM\JoinTable(name="words_categories",
     *     joinColumns={@ORM\JoinColumn(name="word_id", referencedColumnName="id", onDelete="cascade")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="cascade")}
     * )
     * @var ArrayCollection
     */
    protected $categories;

    /**
     * Owning side.
     * @ORM\ManyToMany(targetEntity="Source")
     * @ORM\JoinTable(name="words_sources",
     *     joinColumns={@ORM\JoinColumn(name="word_id", referencedColumnName="id", onDelete="cascade")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="source_id", referencedColumnName="id", onDelete="cascade")}
     * )
     * @var ArrayCollection
     */
    protected $sources;

    /**
     * @var ArrayCollection
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

    public function getId(): int
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

    public function getLanguageNotePronunciation(): string
    {
        return $this->languageNotePronunciation;
    }

    public function setLanguageNotePronunciation(string $languageNotePronunciation): void
    {
        $this->languageNotePronunciation = $languageNotePronunciation;
    }

    public function getLanguageNoteInflection(): string
    {
        return $this->languageNoteInflection;
    }

    public function setLanguageNoteInflection(string $languageNoteInflection): void
    {
        $this->languageNoteInflection = $languageNoteInflection;
    }

    public function getLanguageNoteExceptionToInflection(): string
    {
        return $this->languageNoteExceptionToInflection;
    }

    public function setLanguageNoteExceptionToInflection(string $languageNoteExceptionToInflection): void
    {
        $this->languageNoteExceptionToInflection = $languageNoteExceptionToInflection;
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

    public function addSource(Source $source): void
    {
        if (!$this->sources->contains($source)) {
            $this->sources->add($source);
        }
    }

    public function removeSource(Source $source): void
    {
        if ($this->sources->contains($source)) {
            $this->sources->removeElement($source);
        }
    }

    /**
     * @return Source[]
     */
    public function getSources(): array
    {
        return $this->sources->toArray();
    }

    public function removeSources(): void
    {
        $this->sources->clear();
    }

    public function addCategory(WordCategory $category): void
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }
    }

    public function removeCategory(WordCategory $category): void
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }
    }

    /**
     * @return WordCategory[]
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
     * @return Translation[]
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

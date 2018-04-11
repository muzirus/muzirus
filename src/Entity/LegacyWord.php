<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\Timestamps;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LegacyWordRepository")
 * @ORM\Table(name="legacy_words")
 * @ORM\HasLifecycleCallbacks()
 */
class LegacyWord
{
    use Timestamps;

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="original")
     * @var string
     */
    private $original = '';

    /**
     * @ORM\Column(type="string", name="category")
     * @var string
     */
    private $category = '';

    /**
     * @ORM\Column(type="integer", name="document_id", options={"default":0})
     * @var int
     */
    private $documentId = 0;

    /**
     * @ORM\Column(type="text", name="explanation")
     * @var string
     */
    private $explanation = '';

    /**
     * @ORM\Column(type="text", name="language_note")
     * @var string
     */
    private $languageNote = '';

    /**
     * @ORM\Column(type="text", name="translation")
     * @var string
     */
    private $translation = '';

    /**
     * @ORM\Column(type="text", name="source")
     * @var string
     */
    private $source = '';

    /**
     * @ORM\Column(type="boolean", name="approved_1", options={"default":false})
     * @var bool
     */
    private $approved1 = false;

    /**
     * @ORM\Column(type="boolean", name="approved_2", options={"default":false})
     * @var bool
     */
    private $approved2 = false;

    /**
     * @ORM\Column(type="boolean", name="approved_3", options={"default":false})
     * @var bool
     */
    private $approved3 = false;

    /**
     * @ORM\Column(type="boolean", name="approved_4", options={"default":false})
     * @var bool
     */
    private $approved4 = false;

    /**
     * @ORM\Column(type="boolean", name="hidden", options={"default":false})
     * @var bool
     */
    private $hidden = false;

    /**
     * @ORM\Column(type="boolean", name="deleted", options={"default":false})
     * @var bool
     */
    private $deleted = false;

    /**
     * @ORM\Column(type="boolean", name="imported", options={"default":false})
     * @var bool
     */
    private $imported = false;

    //-------------------------------------------------------------------------

    public function getId(): string
    {
        return $this->id;
    }

    public function getOriginal(): string
    {
        return $this->original;
    }

    public function setOriginal(string $original): void
    {
        $this->original = $original;
    }

    public function hasCategory(): bool
    {
        return empty($this->category) === false;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function getDocumentId(): int
    {
        return $this->documentId;
    }

    public function setDocumentId(int $documentId): void
    {
        $this->documentId = $documentId;
    }

    public function hasExplanation(): bool
    {
        return empty($this->explanation) === false;
    }

    public function getExplanation(): string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): void
    {
        $this->explanation = $explanation;
    }

    public function hasLanguageNote(): bool
    {
        return empty($this->languageNote) === false;
    }

    public function getLanguageNote(): string
    {
        return $this->languageNote;
    }

    public function setLanguageNote(string $languageNote): void
    {
        $this->languageNote = $languageNote;
    }

    public function hasTranslation(): bool
    {
        return empty($this->translation) === false;
    }

    public function getTranslation(): string
    {
        return $this->translation;
    }

    public function setTranslation(string $translation): void
    {
        $this->translation = $translation;
    }

    public function hasSource(): bool
    {
        return empty($this->source) === false;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    public function isApproved1(): bool
    {
        return $this->approved1;
    }

    public function setApproved1(bool $approved1): void
    {
        $this->approved1 = $approved1;
    }

    public function isApproved2(): bool
    {
        return $this->approved2;
    }

    public function setApproved2(bool $approved2): void
    {
        $this->approved2 = $approved2;
    }

    public function isApproved3(): bool
    {
        return $this->approved3;
    }

    public function setApproved3(bool $approved3): void
    {
        $this->approved3 = $approved3;
    }

    public function isApproved4(): bool
    {
        return $this->approved4;
    }

    public function setApproved4(bool $approved4): void
    {
        $this->approved4 = $approved4;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    public function isImported(): bool
    {
        return $this->imported;
    }

    public function setImported(bool $imported): void
    {
        $this->imported = $imported;
    }
}

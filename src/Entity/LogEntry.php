<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LogEntryRepository")
 * @ORM\Table(name="log_entries")
 * @ORM\HasLifecycleCallbacks()
 */
class LogEntry implements LogEntryInterface
{
    use TimestampsTrait;

    //-------------------------------------------------------------------------

    public const NAME_CATEGORY_CREATED = 'category.created';
    public const NAME_CATEGORY_UPDATED = 'category.updated';
    public const NAME_RUSSIAN_WORD_CREATED = 'russian_word.created';
    public const NAME_RUSSIAN_WORD_UPDATED = 'russian_word.updated';
    public const NAME_CZECH_WORD_CREATED = 'czech_word.created';
    public const NAME_CZECH_WORD_UPDATED = 'czech_word.updated';
    public const NAME_SOURCE_CREATED = 'source.created';
    public const NAME_SOURCE_UPDATED = 'source.updated';
    public const NAME_SOURCE_TYPE_CREATED = 'source_type.created';
    public const NAME_SOURCE_TYPE_UPDATED = 'source_type.updated';
    public const NAME_TRANSLATION_CREATED = 'translation.created';
    public const NAME_TRANSLATION_UPDATED = 'translation.updated';
    public const NAME_TRANSLATION_EXAMPLE_CREATED = 'translation_example.created';
    public const NAME_TRANSLATION_EXAMPLE_UPDATED = 'translation_example.updated';

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="name")
     * @var string
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     * @var UserInterface|null
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="RussianWord")
     * @ORM\JoinColumn(name="russian_word_id", referencedColumnName="id", onDelete="CASCADE")
     * @var RussianWordInterface|null
     */
    private $russianWord;

    /**
     * @ORM\ManyToOne(targetEntity="CzechWord")
     * @ORM\JoinColumn(name="czech_word_id", referencedColumnName="id", onDelete="CASCADE")
     * @var CzechWordInterface|null
     */
    private $czechWord;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     * @var CategoryInterface|null
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Source")
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id", onDelete="CASCADE")
     * @var SourceInterface|null
     */
    private $source;

    /**
     * @ORM\ManyToOne(targetEntity="SourceType")
     * @ORM\JoinColumn(name="source_type_id", referencedColumnName="id", onDelete="CASCADE")
     * @var SourceTypeInterface|null
     */
    private $sourceType;

    /**
     * @ORM\ManyToOne(targetEntity="Translation")
     * @ORM\JoinColumn(name="translation_id", referencedColumnName="id", onDelete="CASCADE")
     * @var TranslationInterface|null
     */
    private $translation;

    /**
     * @ORM\ManyToOne(targetEntity="TranslationExample")
     * @ORM\JoinColumn(name="translation_example_id", referencedColumnName="id", onDelete="CASCADE")
     * @var TranslationExampleInterface|null
     */
    private $translationExample;

    //-------------------------------------------------------------------------

    public function __construct(string $name, UserInterface $user)
    {
        $this->name = $name;
        $this->user = $user;
    }

    //-------------------------------------------------------------------------

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function setRussianWord(RussianWordInterface $word): void
    {
        $this->russianWord = $word;
    }

    public function getRussianWord(): ?RussianWordInterface
    {
        return $this->russianWord;
    }

    public function setCzechWord(CzechWordInterface $word): void
    {
        $this->czechWord = $word;
    }

    public function getCzechWord(): ?CzechWordInterface
    {
        return $this->czechWord;
    }

    public function setCategory(CategoryInterface $category): void
    {
        $this->category = $category;
    }

    public function getCategory(): ?CategoryInterface
    {
        return $this->category;
    }

    public function setSource(SourceInterface $source): void
    {
        $this->source = $source;
    }

    public function getSource(): ?SourceInterface
    {
        return $this->source;
    }

    public function setSourceType(SourceTypeInterface $sourceType): void
    {
        $this->sourceType = $sourceType;
    }

    public function getSourceType(): ?SourceTypeInterface
    {
        return $this->sourceType;
    }

    public function setTranslation(TranslationInterface $translation): void
    {
        $this->translation = $translation;
    }

    public function getTranslation(): ?TranslationInterface
    {
        return $this->translation;
    }

    public function setTranslationExample(TranslationExampleInterface $translationExample): void
    {
        $this->translationExample = $translationExample;
    }

    public function getTranslationExample(): ?TranslationExampleInterface
    {
        return $this->translationExample;
    }
}

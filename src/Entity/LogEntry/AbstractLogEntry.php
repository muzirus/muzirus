<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\Able\TimestampableInterface;
use App\Entity\Category;
use App\Entity\CzechWord;
use App\Entity\RussianWord;
use App\Entity\Source;
use App\Entity\SourceType;
use App\Entity\Translation;
use App\Entity\TranslationExample;
use App\Entity\User;
use App\EntityTrait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LogEntryRepository")
 * @ORM\Table(name="log_entries")
 * @ORM\HasLifecycleCallbacks()
 */
abstract class AbstractLogEntry implements TimestampableInterface
{
    use TimestampsTrait;

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="id")
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     * @var User|null
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="RussianWord")
     * @ORM\JoinColumn(name="russian_word_id", referencedColumnName="id", onDelete="CASCADE")
     * @var RussianWord|null
     */
    protected $russianWord;

    /**
     * @ORM\ManyToOne(targetEntity="CzechWord")
     * @ORM\JoinColumn(name="czech_word_id", referencedColumnName="id", onDelete="CASCADE")
     * @var CzechWord|null
     */
    protected $czechWord;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Category|null
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="Source")
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Source|null
     */
    protected $source;

    /**
     * @ORM\ManyToOne(targetEntity="SourceType")
     * @ORM\JoinColumn(name="source_type_id", referencedColumnName="id", onDelete="CASCADE")
     * @var SourceType|null
     */
    protected $sourceType;

    /**
     * @ORM\ManyToOne(targetEntity="Translation")
     * @ORM\JoinColumn(name="translation_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Translation|null
     */
    protected $translation;

    /**
     * @ORM\ManyToOne(targetEntity="TranslationExample")
     * @ORM\JoinColumn(name="translation_example_id", referencedColumnName="id", onDelete="CASCADE")
     * @var TranslationExample|null
     */
    protected $translationExample;

    //-------------------------------------------------------------------------

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    //-------------------------------------------------------------------------

    final public function getId(): int
    {
        return $this->id;
    }

    final public function getUser(): ?User
    {
        return $this->user;
    }

    final public function getClass(): string
    {
        return get_class($this);
    }

    abstract public function toString(): string;
}

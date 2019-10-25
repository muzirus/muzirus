<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\Able\TimestampableInterface;
use App\Entity\UserInterface;
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
     * @var UserInterface|null
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="RussianWord")
     * @ORM\JoinColumn(name="russian_word_id", referencedColumnName="id", onDelete="CASCADE")
     * @var RussianWordInterface|null
     */
    protected $russianWord;

    /**
     * @ORM\ManyToOne(targetEntity="CzechWord")
     * @ORM\JoinColumn(name="czech_word_id", referencedColumnName="id", onDelete="CASCADE")
     * @var CzechWordInterface|null
     */
    protected $czechWord;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     * @var CategoryInterface|null
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="Source")
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id", onDelete="CASCADE")
     * @var SourceInterface|null
     */
    protected $source;

    /**
     * @ORM\ManyToOne(targetEntity="SourceType")
     * @ORM\JoinColumn(name="source_type_id", referencedColumnName="id", onDelete="CASCADE")
     * @var SourceTypeInterface|null
     */
    protected $sourceType;

    /**
     * @ORM\ManyToOne(targetEntity="Translation")
     * @ORM\JoinColumn(name="translation_id", referencedColumnName="id", onDelete="CASCADE")
     * @var TranslationInterface|null
     */
    protected $translation;

    /**
     * @ORM\ManyToOne(targetEntity="TranslationExample")
     * @ORM\JoinColumn(name="translation_example_id", referencedColumnName="id", onDelete="CASCADE")
     * @var TranslationExampleInterface|null
     */
    protected $translationExample;

    //-------------------------------------------------------------------------

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    //-------------------------------------------------------------------------

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }
}

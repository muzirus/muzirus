<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SourceRepository")
 * @ORM\Table(name="sources")
 * @ORM\HasLifecycleCallbacks()
 */
class Source implements SourceInterface
{
    use TimestampsTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", name="title")
     */
    private string $title = '';

    /**
     * Owning side.
     *
     * @ORM\ManyToOne(targetEntity="SourceType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    private SourceTypeInterface $type;

    /**
     * @ORM\Column(type="string", name="name_of_author")
     */
    private string $nameOfAuthor = '';

    /**
     * @ORM\Column(type="string", name="name_of_publisher")
     */
    private string $nameOfPublisher = '';

    /**
     * @ORM\Column(type="string", name="date_of_release")
     */
    private string $dateOfRelease = '';

    /**
     * @ORM\Column(type="string", name="place_of_release")
     */
    private string $placeOfRelease = '';

    /**
     * @ORM\Column(type="integer", name="pages_count")
     */
    private int $pagesCount = 0;

    /**
     * @ORM\Column(type="string", name="isbn_code")
     */
    private string $isbnCode = '';

    /**
     * @ORM\Column(type="string", name="note")
     */
    private string $note = '';

    //-------------------------------------------------------------------------

    public function __construct(string $title, SourceTypeInterface $type)
    {
        $this->setTitle($title);
        $this->setType($type);
    }

    public function __toString(): string
    {
        return $this->getTitle();
    }

    //-------------------------------------------------------------------------

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getType(): SourceTypeInterface
    {
        return $this->type;
    }

    public function setType(SourceTypeInterface $type): void
    {
        $this->type = $type;
    }

    public function getNameOfAuthor(): string
    {
        return $this->nameOfAuthor;
    }

    public function setNameOfAuthor(string $nameOfAuthor): void
    {
        $this->nameOfAuthor = $nameOfAuthor;
    }

    public function getNameOfPublisher(): string
    {
        return $this->nameOfPublisher;
    }

    public function setNameOfPublisher(string $nameOfPublisher): void
    {
        $this->nameOfPublisher = $nameOfPublisher;
    }

    public function getDateOfRelease(): string
    {
        return $this->dateOfRelease;
    }

    public function setDateOfRelease(string $dateOfRelease): void
    {
        $this->dateOfRelease = $dateOfRelease;
    }

    public function getPlaceOfRelease(): string
    {
        return $this->placeOfRelease;
    }

    public function setPlaceOfRelease(string $placeOfRelease): void
    {
        $this->placeOfRelease = $placeOfRelease;
    }

    public function getPagesCount(): int
    {
        return $this->pagesCount;
    }

    public function setPagesCount(int $pagesCount): void
    {
        $this->pagesCount = $pagesCount;
    }

    public function getIsbnCode(): string
    {
        return $this->isbnCode;
    }

    public function setIsbnCode(string $isbnCode): void
    {
        $this->isbnCode = $isbnCode;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }
}

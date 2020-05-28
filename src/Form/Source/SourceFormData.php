<?php declare(strict_types=1);

namespace App\Form\Source;

use App\Entity\SourceInterface;
use App\Entity\SourceTypeInterface;
use Symfony\Component\Validator\Constraints as Assert;

class SourceFormData implements SourceFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $title = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Type("object")
     */
    private SourceTypeInterface $type;

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $nameOfAuthor = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $nameOfPublisher = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $dateOfRelease = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $placeOfRelease = '';

    /**
     * @Assert\Type("integer")
     * @Assert\GreaterThanOrEqual(0)
     */
    private int $pagesCount = 0;

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $isbnCode = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $note = '';

    //-------------------------------------------------------------------------

    public static function createFromSource(SourceInterface $source): self
    {
        $formData = new self();

        $formData->setTitle($source->getTitle());
        $formData->setType($source->getType());
        $formData->setNameOfAuthor($source->getNameOfAuthor());
        $formData->setNameOfPublisher($source->getNameOfPublisher());
        $formData->setDateOfRelease($source->getDateOfRelease());
        $formData->setPlaceOfRelease($source->getPlaceOfRelease());
        $formData->setPagesCount($source->getPagesCount());
        $formData->setIsbnCode($source->getIsbnCode());
        $formData->setNote($source->getNote());

        return $formData;
    }

    //-------------------------------------------------------------------------

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getType(): ?SourceTypeInterface
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

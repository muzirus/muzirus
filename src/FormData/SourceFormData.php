<?php

namespace App\FormData;

use App\Entity\Source;

class SourceFormData
{
    /**
     * @var string
     */
    private $title = '';

    /**
     * @var int
     */
    private $typeId = 0;

    /**
     * @var string
     */
    private $nameOfAuthor = '';

    /**
     * @var string
     */
    private $nameOfPublisher = '';

    /**
     * @var string
     */
    private $dateOfRelease = '';

    /**
     * @var string
     */
    private $placeOfRelease = '';

    /**
     * @var int
     */
    private $pagesCount = 0;

    /**
     * @var string
     */
    private $isbnCode = '';

    /**
     * @var string
     */
    private $note = '';

    //-------------------------------------------------------------------------

    public static function createFromSource(Source $source): self
    {
        $formData = new self();

        $formData->setTitle($source->getTitle());
        $formData->setTypeId($source->getType()->getId());
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

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): void
    {
        $this->typeId = $typeId;
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

<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;

interface SourceInterface extends TimestampableInterface
{
    public function __toString(): string;

    public function getId(): string;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getType(): SourceTypeInterface;

    public function setType(SourceTypeInterface $type): void;

    public function getNameOfAuthor(): string;

    public function setNameOfAuthor(string $nameOfAuthor): void;

    public function getNameOfPublisher(): string;

    public function setNameOfPublisher(string $nameOfPublisher): void;

    public function getDateOfRelease(): string;

    public function setDateOfRelease(string $dateOfRelease): void;

    public function getPlaceOfRelease(): string;

    public function setPlaceOfRelease(string $placeOfRelease): void;

    public function getPagesCount(): int;

    public function setPagesCount(int $pagesCount): void;

    public function getIsbnCode(): string;

    public function setIsbnCode(string $isbnCode): void;

    public function getNote(): string;

    public function setNote(string $note): void;
}

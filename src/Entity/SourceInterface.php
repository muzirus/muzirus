<?php

namespace App\Entity;

use App\Entity\Able\Timestampable;

interface SourceInterface extends Timestampable
{
    public function __toString(): string;

    public function getId(): int;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getType(): SourceType;

    public function setType(SourceType $type): void;

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

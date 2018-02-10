<?php

namespace App\Entity;

use App\Entity\Able\Timestampable;

interface AbbreviationInterface extends Timestampable
{
    public function __toString(): string;

    public function getId(): int;

    public function getTitle(): string;

    public function setTitle(string $title): void;

    public function getContent(): string;

    public function setContent(string $content): void;

    public function getDescription(): string;

    public function setDescription(string $description): void;
}

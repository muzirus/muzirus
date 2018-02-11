<?php

namespace App\Entity;

use App\Entity\Able\Timestampable;

interface SourceTypeInterface extends Timestampable
{
    public function __toString(): string;

    public function getId(): int;

    public function getTitle(): string;

    public function setTitle(string $title): void;
}
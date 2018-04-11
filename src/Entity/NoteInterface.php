<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\Timestampable;

interface NoteInterface extends Timestampable
{
    public function __toString(): string;

    public function getId(): int;

    public function getUser(): UserInterface;

    public function getContent(): string;

    public function setContent(string $content): void;
}

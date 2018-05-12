<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;

interface NoteInterface extends TimestampableInterface
{
    public function __toString(): string;

    public function getId(): string;

    public function getUser(): UserInterface;

    public function getContent(): string;

    public function setContent(string $content): void;
}

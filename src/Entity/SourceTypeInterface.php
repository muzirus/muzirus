<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;

interface SourceTypeInterface extends TimestampableInterface
{
    public function __toString(): string;

    public function getId(): string;

    public function getTitle(): string;

    public function setTitle(string $title): void;
}

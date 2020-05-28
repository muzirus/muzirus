<?php declare(strict_types=1);

namespace App\Entity\Able;

interface TimestampableInterface
{
    public function getCreatedAt(): \DateTimeInterface;

    public function getCreatedAtFormat(string $format = 'Y-m-d H:i'): string;

    public function getUpdatedAt(): \DateTimeInterface;

    public function getUpdatedAtFormat(string $format = 'Y-m-d H:i'): string;
}

<?php declare(strict_types=1);

namespace App\Entity\Able;

interface TimestampableInterface
{
    public function getCreatedAt(): \DateTimeInterface;

    public function getUpdatedAt(): \DateTimeInterface;
}

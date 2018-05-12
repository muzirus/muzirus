<?php declare(strict_types=1);

namespace App\Entity\Able;

interface TimestampableInterface
{
    public function getCreatedAt(): \DateTime;

    public function getCreatedAtFormat(string $format = 'Y-m-d H:i'): string;

    public function getUpdatedAt(): \DateTime;

    public function getUpdatedAtFormat(string $format = 'Y-m-d H:i'): string;
}

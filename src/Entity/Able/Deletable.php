<?php declare(strict_types=1);

namespace App\Entity\Able;

interface Deletable
{
    public function markDeleted(): void;

    public function isDeleted(): bool;
}

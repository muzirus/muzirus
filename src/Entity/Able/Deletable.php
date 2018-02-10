<?php

namespace App\Entity\Able;

interface Deletable
{
    public function markDeleted(): void;

    public function isDeleted(): bool;
}

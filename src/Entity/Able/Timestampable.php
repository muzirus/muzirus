<?php

namespace App\Entity\Able;

interface Timestampable
{
    public function getCreatedAt(): \DateTime;

    public function getCreatedAtFormat(string $format = 'Y-m-d H:i'): string;

    public function getUpdatedAt(): \DateTime;

    public function getUpdatedAtFormat(string $format = 'Y-m-d H:i'): string;
}
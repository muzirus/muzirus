<?php

namespace App\Entity\Able;

use App\Entity\UserInterface;

interface Refusable
{
    /**
     * @return UserInterface[]
     */
    public function getUsersThatRefused(): array;

    public function countUsersThatRefused(): int;

    public function hasRefusalFromUser(UserInterface $user): bool;

    public function addRefusalFromUser(UserInterface $user): void;

    public function removeRefusalFromUser(UserInterface $user): void;
}

<?php

namespace App\Entity\Able;

use App\Entity\UserInterface;

interface Approvable
{
    /**
     * @return UserInterface[]
     */
    public function getUsersThatApproved(): array;

    public function countUsersThatApproved(): int;

    public function hasApprovalFromUser(UserInterface $user): bool;

    public function addApprovalFromUser(UserInterface $user): void;

    public function removeApprovalFromUser(UserInterface $user): void;
}

<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\UserInterface;

interface EventInterface
{
    public function getUser(): UserInterface;
}

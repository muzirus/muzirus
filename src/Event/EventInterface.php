<?php

namespace App\Event;

use App\Entity\UserInterface;

interface EventInterface
{
    public function getUser(): UserInterface;
}

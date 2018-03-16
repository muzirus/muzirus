<?php

namespace App\Event;

use App\Entity\RussianWordInterface;
use App\Entity\UserInterface;

class RussianWordEvent extends AbstractEvent
{
    /** @var RussianWordInterface */
    private $word;

    public function __construct(UserInterface $user, RussianWordInterface $word)
    {
        parent::__construct($user);
        $this->word = $word;
    }

    public function getWord(): RussianWordInterface
    {
        return $this->word;
    }
}

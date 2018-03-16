<?php

namespace App\Event;

use App\Entity\CzechWordInterface;
use App\Entity\UserInterface;

class CzechWordEvent extends AbstractEvent
{
    /** @var CzechWordInterface */
    private $word;

    public function __construct(UserInterface $user, CzechWordInterface $word)
    {
        parent::__construct($user);
        $this->word = $word;
    }

    public function getWord(): CzechWordInterface
    {
        return $this->word;
    }
}

<?php

namespace App\Event;

use App\Entity\AbstractWordInterface;
use App\Entity\User;
use Symfony\Component\EventDispatcher\Event;

class WordEvent extends Event
{
    /**
     * @var AbstractWordInterface
     */
    private $word;

    /**
     * @var User
     */
    private $user;

    public function __construct(AbstractWordInterface $word, User $user)
    {
        $this->word = $word;
        $this->user = $user;
    }

    /**
     * @return AbstractWordInterface
     */
    public function getWord(): AbstractWordInterface
    {
        return $this->word;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}

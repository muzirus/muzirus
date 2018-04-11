<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\UserInterface;
use Symfony\Component\EventDispatcher\Event;

abstract class AbstractEvent extends Event implements EventInterface
{
    /** @var UserInterface */
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}

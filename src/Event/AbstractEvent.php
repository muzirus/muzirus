<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\UserInterface;
use Symfony\Contracts\EventDispatcher\Event;

abstract class AbstractEvent extends Event
{
    /** @var UserInterface */
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    final public function getUser(): UserInterface
    {
        return $this->user;
    }
}

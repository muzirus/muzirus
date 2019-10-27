<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\User;
use Symfony\Contracts\EventDispatcher\Event;

abstract class AbstractEvent extends Event
{
    /** @var User */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    final public function getUser(): User
    {
        return $this->user;
    }
}

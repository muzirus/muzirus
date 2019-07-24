<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\RussianWordInterface;
use App\Entity\UserInterface;

class RussianWordCreatedEvent extends AbstractEvent
{
    /** @var RussianWordInterface */
    private $word;

    public function __construct(UserInterface $user, RussianWordInterface $word)
    {
        parent::__construct($user);
        $this->word = $word;
    }

    final public function getWord(): RussianWordInterface
    {
        return $this->word;
    }
}

<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\CzechWordInterface;
use App\Entity\UserInterface;

class CzechWordCreatedEvent extends AbstractEvent
{
    private CzechWordInterface $word;

    public function __construct(UserInterface $user, CzechWordInterface $word)
    {
        parent::__construct($user);
        $this->word = $word;
    }

    final public function getWord(): CzechWordInterface
    {
        return $this->word;
    }
}

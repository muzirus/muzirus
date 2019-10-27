<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\RussianWord;
use App\Entity\User;

class RussianWordCreatedEvent extends AbstractEvent
{
    /** @var RussianWord */
    private $word;

    public function __construct(User $user, RussianWord $word)
    {
        parent::__construct($user);
        $this->word = $word;
    }

    final public function getWord(): RussianWord
    {
        return $this->word;
    }
}

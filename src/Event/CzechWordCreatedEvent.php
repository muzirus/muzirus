<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\CzechWord;
use App\Entity\User;

class CzechWordCreatedEvent extends AbstractEvent
{
    /** @var CzechWord */
    private $word;

    public function __construct(User $user, CzechWord $word)
    {
        parent::__construct($user);
        $this->word = $word;
    }

    final public function getWord(): CzechWord
    {
        return $this->word;
    }
}

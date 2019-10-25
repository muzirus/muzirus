<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\RussianWord;
use App\Entity\User;

class RussianWordCreatedAbstractLogEntry extends AbstractLogEntry
{
    public function __construct(User $user, RussianWord $russianWord)
    {
        parent::__construct($user);

        $this->russianWord = $russianWord;
    }

    //-------------------------------------------------------------------------

    public function getRussianWord(): ?RussianWord
    {
        return $this->russianWord;
    }
}

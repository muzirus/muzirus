<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\CzechWord;
use App\Entity\User;

class CzechWordUpdated extends AbstractLogEntry
{
    public function __construct(User $user, CzechWord $czechWord)
    {
        parent::__construct($user);

        $this->czechWord = $czechWord;
    }

    //-------------------------------------------------------------------------

    public function getCzechWord(): ?CzechWord
    {
        return $this->czechWord;
    }

    public function toString(): string
    {
        return 'Czech word has been updated';
    }
}

<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\RussianWord;
use App\Entity\User;

class RussianWordUpdated extends RussianWordCreated
{
    public function toString(): string
    {
        return 'Russian word has been updated';
    }
}

<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\CzechWord;
use App\Entity\User;

class CzechWordUpdated extends CzechWordCreated
{
    public function toString(): string
    {
        return 'Czech word has been updated';
    }
}

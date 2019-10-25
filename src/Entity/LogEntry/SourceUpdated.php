<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\Source;
use App\Entity\User;

class SourceUpdated extends SourceCreated
{
    public function toString(): string
    {
        return 'Source has been updated';
    }
}

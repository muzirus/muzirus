<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\SourceType;
use App\Entity\User;

class SourceTypeUpdated extends SourceTypeCreated
{
    public function toString(): string
    {
        return 'Source type has been updated';
    }
}

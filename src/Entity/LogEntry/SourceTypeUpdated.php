<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\SourceType;
use App\Entity\User;

class SourceTypeUpdated extends AbstractLogEntry
{
    public function __construct(User $user, SourceType $sourceType)
    {
        parent::__construct($user);

        $this->sourceType = $sourceType;
    }

    //-------------------------------------------------------------------------

    public function getSourceType(): ?SourceType
    {
        return $this->sourceType;
    }

    public function toString(): string
    {
        return 'Source type has been updated';
    }
}

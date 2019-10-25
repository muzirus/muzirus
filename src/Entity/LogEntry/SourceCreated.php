<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\Source;
use App\Entity\User;

class SourceCreated extends AbstractLogEntry
{
    public function __construct(User $user, Source $source)
    {
        parent::__construct($user);

        $this->source = $source;
    }

    //-------------------------------------------------------------------------

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function toString(): string
    {
        return 'Source has been created';
    }
}

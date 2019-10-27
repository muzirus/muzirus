<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\SourceType;
use App\Entity\User;

class SourceTypeCreatedEvent extends AbstractEvent
{
    /** @var SourceType */
    private $sourceType;

    public function __construct(User $user, SourceType $sourceType)
    {
        parent::__construct($user);
        $this->sourceType = $sourceType;
    }

    final public function getSourceType(): SourceType
    {
        return $this->sourceType;
    }
}

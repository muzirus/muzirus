<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\SourceTypeInterface;
use App\Entity\UserInterface;

class SourceTypeCreatedEvent extends AbstractEvent
{
    private SourceTypeInterface $sourceType;

    public function __construct(UserInterface $user, SourceTypeInterface $sourceType)
    {
        parent::__construct($user);
        $this->sourceType = $sourceType;
    }

    final public function getSourceType(): SourceTypeInterface
    {
        return $this->sourceType;
    }
}

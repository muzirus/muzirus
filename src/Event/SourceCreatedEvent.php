<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\Source;
use App\Entity\User;

class SourceCreatedEvent extends AbstractEvent
{
    /** @var Source */
    private $source;

    public function __construct(User $user, Source $source)
    {
        parent::__construct($user);
        $this->source = $source;
    }

    final public function getSource(): Source
    {
        return $this->source;
    }
}

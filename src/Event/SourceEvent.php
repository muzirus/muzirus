<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\SourceInterface;
use App\Entity\UserInterface;

class SourceEvent extends AbstractEvent
{
    /** @var SourceInterface */
    private $source;

    public function __construct(UserInterface $user, SourceInterface $source)
    {
        parent::__construct($user);
        $this->source = $source;
    }

    public function getSource(): SourceInterface
    {
        return $this->source;
    }
}

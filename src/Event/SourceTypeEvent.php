<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\SourceTypeInterface;
use App\Entity\UserInterface;

class SourceTypeEvent extends AbstractEvent
{
    /** @var SourceTypeInterface */
    private $sourceType;

    public function __construct(UserInterface $user, SourceTypeInterface $sourceType)
    {
        parent::__construct($user);
        $this->sourceType = $sourceType;
    }

    public function getSourceType(): SourceTypeInterface
    {
        return $this->sourceType;
    }
}

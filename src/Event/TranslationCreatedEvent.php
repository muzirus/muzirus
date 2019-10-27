<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\Translation;
use App\Entity\User;

class TranslationCreatedEvent extends AbstractEvent
{
    /** @var Translation */
    private $translation;

    public function __construct(User $user, Translation $translation)
    {
        parent::__construct($user);
        $this->translation = $translation;
    }

    final public function getTranslation(): Translation
    {
        return $this->translation;
    }
}

<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\TranslationExample;
use App\Entity\User;

class TranslationExampleCreatedEvent extends AbstractEvent
{
    /** @var TranslationExample */
    private $translationExample;

    public function __construct(User $user, TranslationExample $translationExample)
    {
        parent::__construct($user);
        $this->translationExample = $translationExample;
    }

    final public function getTranslationExample(): TranslationExample
    {
        return $this->translationExample;
    }
}

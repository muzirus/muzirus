<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\TranslationInterface;
use App\Entity\UserInterface;

class TranslationCreatedEvent extends AbstractEvent
{
    private TranslationInterface $translation;

    public function __construct(UserInterface $user, TranslationInterface $translation)
    {
        parent::__construct($user);
        $this->translation = $translation;
    }

    final public function getTranslation(): TranslationInterface
    {
        return $this->translation;
    }
}

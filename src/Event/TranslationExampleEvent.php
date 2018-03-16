<?php

namespace App\Event;

use App\Entity\TranslationExampleInterface;
use App\Entity\UserInterface;

class TranslationExampleEvent extends AbstractEvent
{
    /** @var TranslationExampleInterface */
    private $translationExample;

    public function __construct(UserInterface $user, TranslationExampleInterface $translationExample)
    {
        parent::__construct($user);
        $this->translationExample = $translationExample;
    }

    public function getTranslationExample(): TranslationExampleInterface
    {
        return $this->translationExample;
    }
}

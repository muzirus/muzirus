<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\TranslationInterface;
use App\Entity\UserInterface;

class TranslationEvent extends AbstractEvent
{
    /** @var TranslationInterface */
    private $translation;

    public function __construct(UserInterface $user, TranslationInterface $translation)
    {
        parent::__construct($user);
        $this->translation = $translation;
    }

    public function getTranslation(): TranslationInterface
    {
        return $this->translation;
    }
}

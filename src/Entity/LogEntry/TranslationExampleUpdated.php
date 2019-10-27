<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\TranslationExample;
use App\Entity\User;

class TranslationExampleUpdated extends AbstractLogEntry
{
    public function __construct(User $user, TranslationExample $translationExample)
    {
        parent::__construct($user);

        $this->translationExample = $translationExample;
    }

    //-------------------------------------------------------------------------

    public function getTranslationExample(): ?TranslationExample
    {
        return $this->translationExample;
    }

    public function toString(): string
    {
        return 'Translation example has been updated';
    }
}

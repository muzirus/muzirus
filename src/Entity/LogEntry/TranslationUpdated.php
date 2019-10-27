<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\Translation;
use App\Entity\User;

class TranslationUpdated extends AbstractLogEntry
{
    public function __construct(User $user, Translation $translation)
    {
        parent::__construct($user);

        $this->translation = $translation;
    }

    //-------------------------------------------------------------------------

    public function getTranslation(): ?Translation
    {
        return $this->translation;
    }

    public function toString(): string
    {
        return 'Translation has been updated';
    }
}

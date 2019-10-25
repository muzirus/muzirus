<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\Translation;
use App\Entity\User;

class TranslationUpdated extends TranslationCreated
{
    public function toString(): string
    {
        return 'Translation has been updated';
    }
}

<?php declare(strict_types=1);

namespace App\Entity\LogEntry;

use App\Entity\TranslationExample;
use App\Entity\User;

class TranslationExampleUpdated extends TranslationExampleCreated
{
    public function toString(): string
    {
        return 'Translation example has been updated';
    }
}

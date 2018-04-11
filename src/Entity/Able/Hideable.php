<?php declare(strict_types=1);

namespace App\Entity\Able;

/**
 * Capable of being hidden.
 */
interface Hideable
{
    public function markHidden(): void;

    public function isHidden(): bool;

    public function markVisible(): void;

    public function isVisible(): bool;
}

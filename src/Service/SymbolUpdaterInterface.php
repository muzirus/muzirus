<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\SymbolInterface;
use App\Form\Symbol\SymbolFormDataInterface;

interface SymbolUpdaterInterface
{
    public function updateSymbol(SymbolInterface $symbol, SymbolFormDataInterface $formData): void;
}

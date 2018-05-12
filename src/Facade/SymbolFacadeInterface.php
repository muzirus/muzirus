<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\SymbolInterface;
use App\Form\Symbol\SymbolFormDataInterface;

interface SymbolFacadeInterface
{
    public function createSymbol(SymbolFormDataInterface $formData): SymbolInterface;

    public function updateSymbol(SymbolInterface $symbol, SymbolFormDataInterface $formData): void;

    public function deleteSymbol(SymbolInterface $symbol): void;
}

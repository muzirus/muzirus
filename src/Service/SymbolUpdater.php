<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\SymbolInterface;
use App\Form\Symbol\SymbolFormData;

class SymbolUpdater
{
    public function updateSymbol(SymbolInterface $symbol, SymbolFormData $formData): void
    {
        $symbol->setTitle($formData->getTitle());
        $symbol->setContent($formData->getContent());
        $symbol->setDescription($formData->getDescription());
    }
}

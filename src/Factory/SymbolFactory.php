<?php

namespace App\Factory;

use App\Entity\Symbol;
use App\Entity\SymbolInterface;
use App\Form\Symbol\SymbolFormData;

class SymbolFactory
{
    public function createFromFormData(SymbolFormData $formData): SymbolInterface
    {
        return new Symbol(
            $formData->getTitle(),
            $formData->getContent(),
            $formData->getDescription()
        );
    }
}

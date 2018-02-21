<?php

namespace App\Factory;

use App\Entity\Symbol;
use App\FormData\SymbolFormData;

class SymbolFactory
{
    public function createFromFormData(SymbolFormData $formData): Symbol
    {
        return new Symbol(
            $formData->getTitle(),
            $formData->getContent(),
            $formData->getDescription()
        );
    }
}
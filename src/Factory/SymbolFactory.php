<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\Symbol;
use App\Entity\SymbolInterface;
use App\Form\Symbol\SymbolFormDataInterface;

class SymbolFactory implements SymbolFactoryInterface
{
    public function createFromFormData(SymbolFormDataInterface $formData): SymbolInterface
    {
        return new Symbol(
            $formData->getTitle(),
            $formData->getContent(),
            $formData->getDescription()
        );
    }
}

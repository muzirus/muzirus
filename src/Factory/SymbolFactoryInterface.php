<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\SymbolInterface;
use App\Form\Symbol\SymbolFormDataInterface;

interface SymbolFactoryInterface
{
    public function createFromFormData(SymbolFormDataInterface $formData): SymbolInterface;
}

<?php

namespace App\Tests\Factory;

use App\Factory\SymbolFactory;
use App\Form\Symbol\SymbolFormData;
use PHPUnit\Framework\TestCase;

class SymbolFactoryTest extends TestCase
{
    /** @var SymbolFactory */
    private $symbolFactory;

    public function setUp(): void
    {
        $this->symbolFactory = new SymbolFactory();
    }

    public function testCreateFromFormData(): void
    {
        $value = 'value';
        $title = 'title';
        $description = 'description';
        $symbolFormData = new SymbolFormData();
        $symbolFormData->setContent($value);
        $symbolFormData->setTitle($title);
        $symbolFormData->setDescription($description);

        $symbol = $this->symbolFactory->createFromFormData($symbolFormData);

        $this->assertSame($value, $symbol->getContent());
        $this->assertSame($title, $symbol->getTitle());
        $this->assertSame($description, $symbol->getDescription());
    }
}

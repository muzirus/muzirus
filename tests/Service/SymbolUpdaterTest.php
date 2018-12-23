<?php declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Symbol;
use App\Form\Symbol\SymbolFormData;
use App\Service\SymbolUpdater;
use PHPUnit\Framework\TestCase;

class SymbolUpdaterTest extends TestCase
{
    /** @var SymbolUpdater */
    private $symbolUpdater;

    protected function setUp(): void
    {
        $this->symbolUpdater = new SymbolUpdater();
    }

    public function testUpdateFromFormData(): void
    {
        $value = 'value';
        $title = 'title';
        $description = 'description';
        $formData = new SymbolFormData();
        $formData->setContent($value);
        $formData->setTitle($title);
        $formData->setDescription($description);
        $symbol = new Symbol('bla', 'ble', 'blu');

        $this->symbolUpdater->updateSymbol($symbol, $formData);

        $this->assertSame($value, $symbol->getContent());
        $this->assertSame($title, $symbol->getTitle());
        $this->assertSame($description, $symbol->getDescription());
    }
}

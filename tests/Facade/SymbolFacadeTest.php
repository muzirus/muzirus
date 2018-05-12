<?php declare(strict_types=1);

namespace App\Tests\Facade;

use App\Entity\Symbol;
use App\Facade\SymbolFacade;
use App\Factory\SymbolFactory;
use App\Form\Symbol\SymbolFormData;
use App\Service\SymbolUpdater;
use Doctrine\ORM\EntityManagerInterface;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class SymbolFacadeTest extends TestCase
{
    /** @var SymbolFacade */
    private $symbolFacade;

    /** @var EntityManagerInterface|m\Mock */
    private $entityManager;

    /** @var SymbolFactory|m\Mock */
    private $symbolFactory;

    /** @var SymbolUpdater|m\Mock */
    private $symbolUpdater;

    public function setUp(): void
    {
        $this->entityManager = m::spy(EntityManagerInterface::class);
        $this->symbolFactory = m::spy(SymbolFactory::class);
        $this->symbolUpdater = m::spy(SymbolUpdater::class);

        $this->symbolFacade = new SymbolFacade(
            $this->entityManager,
            $this->symbolFactory,
            $this->symbolUpdater
        );
    }

    public function testShouldCreateSymbol(): void
    {
        $formData = m::mock(SymbolFormData::class);
        $symbol = m::mock(Symbol::class);

        $this->symbolFactory->shouldReceive('createFromFormData')
            ->once()
            ->with($formData)
            ->andReturn($symbol);

        $result = $this->symbolFacade->createSymbol($formData);

        $this->assertInstanceOf(Symbol::class, $result);
        $this->entityManager->shouldHaveReceived('persist')
            ->with($symbol)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }

    public function testShouldUpdateSymbol(): void
    {
        $formData = m::mock(SymbolFormData::class);
        $symbol = m::mock(Symbol::class);

        $this->symbolFacade->updateSymbol($symbol, $formData);

        $this->symbolUpdater->shouldHaveReceived('updateSymbol')
            ->with($symbol, $formData)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }

    public function testShouldDeleteSymbol(): void
    {
        $symbol = m::mock(Symbol::class);

        $this->symbolFacade->deleteSymbol($symbol);

        $this->entityManager->shouldHaveReceived('remove')
            ->with($symbol)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }
}

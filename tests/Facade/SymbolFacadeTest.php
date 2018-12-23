<?php declare(strict_types=1);

namespace App\Tests\Facade;

use App\Entity\SymbolInterface;
use App\Facade\SymbolFacade;
use App\Factory\SymbolFactoryInterface;
use App\Form\Symbol\SymbolFormDataInterface;
use App\Service\SymbolUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Mockery;
use PHPUnit\Framework\TestCase;

class SymbolFacadeTest extends TestCase
{
    /** @var SymbolFacade */
    private $symbolFacade;

    /** @var EntityManagerInterface|Mockery\MockInterface */
    private $entityManager;

    /** @var SymbolFactoryInterface|Mockery\MockInterface */
    private $symbolFactory;

    /** @var SymbolUpdaterInterface|Mockery\MockInterface */
    private $symbolUpdater;

    protected function setUp(): void
    {
        $this->entityManager = Mockery::spy(EntityManagerInterface::class);
        $this->symbolFactory = Mockery::spy(SymbolFactoryInterface::class);
        $this->symbolUpdater = Mockery::spy(SymbolUpdaterInterface::class);

        $this->symbolFacade = new SymbolFacade(
            $this->entityManager,
            $this->symbolFactory,
            $this->symbolUpdater
        );
    }

    public function testShouldCreateSymbol(): void
    {
        $formData = Mockery::mock(SymbolFormDataInterface::class);
        $symbol = Mockery::mock(SymbolInterface::class);

        $this->symbolFactory->shouldReceive('createFromFormData')
            ->once()
            ->with($formData)
            ->andReturn($symbol);

        $result = $this->symbolFacade->createSymbol($formData);

        $this->assertInstanceOf(SymbolInterface::class, $result);
        $this->entityManager->shouldHaveReceived('persist')
            ->with($symbol)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }

    public function testShouldUpdateSymbol(): void
    {
        $formData = Mockery::mock(SymbolFormDataInterface::class);
        $symbol = Mockery::mock(SymbolInterface::class);

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
        $symbol = Mockery::mock(SymbolInterface::class);

        $this->symbolFacade->deleteSymbol($symbol);

        $this->entityManager->shouldHaveReceived('remove')
            ->with($symbol)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }
}

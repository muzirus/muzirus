<?php declare(strict_types=1);

namespace App\Tests\Facade;

use App\Entity\SourceInterface;
use App\Facade\SourceFacade;
use App\Factory\SourceFactoryInterface;
use App\Form\Source\SourceFormDataInterface;
use App\Service\SourceUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Mockery;
use PHPUnit\Framework\TestCase;

class SourceFacadeTest extends TestCase
{
    /** @var SourceFacade */
    private $sourceFacade;

    /** @var EntityManagerInterface|Mockery\MockInterface */
    private $entityManager;

    /** @var SourceFactoryInterface|Mockery\MockInterface */
    private $sourceFactory;

    /** @var SourceUpdaterInterface|Mockery\MockInterface */
    private $sourceUpdater;

    protected function setUp(): void
    {
        $this->entityManager = Mockery::spy(EntityManagerInterface::class);
        $this->sourceFactory = Mockery::spy(SourceFactoryInterface::class);
        $this->sourceUpdater = Mockery::spy(SourceUpdaterInterface::class);

        $this->sourceFacade = new SourceFacade(
            $this->entityManager,
            $this->sourceFactory,
            $this->sourceUpdater
        );
    }

    public function testShouldCreateSource(): void
    {
        $formData = Mockery::mock(SourceFormDataInterface::class);
        $source = Mockery::mock(SourceInterface::class);

        $this->sourceFactory->shouldReceive('createFromFormData')
            ->once()
            ->with($formData)
            ->andReturn($source);

        $result = $this->sourceFacade->createSource($formData);

        $this->assertInstanceOf(SourceInterface::class, $result);
        $this->entityManager->shouldHaveReceived('persist')
            ->with($source)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }

    public function testShouldUpdateSource(): void
    {
        $formData = Mockery::mock(SourceFormDataInterface::class);
        $source = Mockery::mock(SourceInterface::class);

        $this->sourceFacade->updateSource($source, $formData);

        $this->sourceUpdater->shouldHaveReceived('updateSource')
            ->with($source, $formData)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }

    public function testShouldDeleteSource(): void
    {
        $source = Mockery::mock(SourceInterface::class);

        $this->sourceFacade->deleteSource($source);

        $this->entityManager->shouldHaveReceived('remove')
            ->with($source)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }
}

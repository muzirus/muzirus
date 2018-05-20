<?php declare(strict_types=1);

namespace App\Tests\Facade;

use App\Entity\SourceInterface;
use App\Facade\SourceFacade;
use App\Factory\SourceFactory;
use App\Form\Source\SourceFormData;
use App\Service\SourceUpdater;
use Doctrine\ORM\EntityManagerInterface;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class SourceFacadeTest extends TestCase
{
    /** @var SourceFacade */
    private $sourceFacade;

    /** @var EntityManagerInterface|m\Mock */
    private $entityManager;

    /** @var SourceFactory|m\Mock */
    private $sourceFactory;

    /** @var SourceUpdater|m\Mock */
    private $sourceUpdater;

    protected function setUp(): void
    {
        $this->entityManager = m::spy(EntityManagerInterface::class);
        $this->sourceFactory = m::spy(SourceFactory::class);
        $this->sourceUpdater = m::spy(SourceUpdater::class);

        $this->sourceFacade = new SourceFacade(
            $this->entityManager,
            $this->sourceFactory,
            $this->sourceUpdater
        );
    }

    public function testShouldCreateSource(): void
    {
        $formData = m::mock(SourceFormData::class);
        $source = m::mock(SourceInterface::class);

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
        $formData = m::mock(SourceFormData::class);
        $source = m::mock(SourceInterface::class);

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
        $source = m::mock(SourceInterface::class);

        $this->sourceFacade->deleteSource($source);

        $this->entityManager->shouldHaveReceived('remove')
            ->with($source)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }
}

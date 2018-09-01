<?php declare(strict_types=1);

namespace App\Tests\Facade;

use App\Entity\Abbreviation;
use App\Facade\AbbreviationFacade;
use App\Factory\AbbreviationFactoryInterface;
use App\Form\Abbreviation\AbbreviationFormData;
use App\Service\AbbreviationUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Mockery;
use PHPUnit\Framework\TestCase;

class AbbreviationFacadeTest extends TestCase
{
    /** @var AbbreviationFacade */
    private $abbreviationFacade;

    /** @var EntityManagerInterface|Mockery\MockInterface */
    private $entityManager;

    /** @var AbbreviationFactoryInterface|Mockery\MockInterface */
    private $abbreviationFactory;

    /** @var AbbreviationUpdaterInterface|Mockery\MockInterface */
    private $abbreviationUpdater;

    protected function setUp(): void
    {
        $this->entityManager = Mockery::spy(EntityManagerInterface::class);
        $this->abbreviationFactory = Mockery::spy(AbbreviationFactoryInterface::class);
        $this->abbreviationUpdater = Mockery::spy(AbbreviationUpdaterInterface::class);

        $this->abbreviationFacade = new AbbreviationFacade(
            $this->entityManager,
            $this->abbreviationFactory,
            $this->abbreviationUpdater
        );
    }

    public function testShouldCreateAbbreviation(): void
    {
        $formData = Mockery::mock(AbbreviationFormData::class);
        $abbreviation = Mockery::mock(Abbreviation::class);

        $this->abbreviationFactory->shouldReceive('createFromFormData')
            ->once()
            ->with($formData)
            ->andReturn($abbreviation);

        $result = $this->abbreviationFacade->createAbbreviation($formData);

        $this->assertInstanceOf(Abbreviation::class, $result);
        $this->entityManager->shouldHaveReceived('persist')
            ->with($abbreviation)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }

    public function testShouldUpdateAbbreviation(): void
    {
        $formData = Mockery::mock(AbbreviationFormData::class);
        $abbreviation = Mockery::mock(Abbreviation::class);

        $this->abbreviationFacade->updateAbbreviation($abbreviation, $formData);

        $this->abbreviationUpdater->shouldHaveReceived('updateAbbreviation')
            ->with($abbreviation, $formData)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }

    public function testShouldDeleteAbbreviation(): void
    {
        $abbreviation = Mockery::mock(Abbreviation::class);

        $this->abbreviationFacade->deleteAbbreviation($abbreviation);

        $this->entityManager->shouldHaveReceived('remove')
            ->with($abbreviation)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }
}

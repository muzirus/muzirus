<?php declare(strict_types=1);

namespace App\Tests\Facade;

use App\Entity\Abbreviation;
use App\Facade\AbbreviationFacade;
use App\Factory\AbbreviationFactory;
use App\Form\Abbreviation\AbbreviationFormData;
use App\Service\AbbreviationUpdater;
use Doctrine\ORM\EntityManagerInterface;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class AbbreviationFacadeTest extends TestCase
{
    /** @var AbbreviationFacade */
    private $abbreviationFacade;

    /** @var EntityManagerInterface|m\Mock */
    private $entityManager;

    /** @var AbbreviationFactory|m\Mock */
    private $abbreviationFactory;

    /** @var AbbreviationUpdater|m\Mock */
    private $abbreviationUpdater;

    protected function setUp(): void
    {
        $this->entityManager = m::spy(EntityManagerInterface::class);
        $this->abbreviationFactory = m::spy(AbbreviationFactory::class);
        $this->abbreviationUpdater = m::spy(AbbreviationUpdater::class);

        $this->abbreviationFacade = new AbbreviationFacade(
            $this->entityManager,
            $this->abbreviationFactory,
            $this->abbreviationUpdater
        );
    }

    public function testShouldCreateAbbreviation(): void
    {
        $formData = m::mock(AbbreviationFormData::class);
        $abbreviation = m::mock(Abbreviation::class);

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
        $formData = m::mock(AbbreviationFormData::class);
        $abbreviation = m::mock(Abbreviation::class);

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
        $abbreviation = m::mock(Abbreviation::class);

        $this->abbreviationFacade->deleteAbbreviation($abbreviation);

        $this->entityManager->shouldHaveReceived('remove')
            ->with($abbreviation)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }
}

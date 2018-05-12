<?php declare(strict_types=1);

namespace App\Tests\Facade;

use App\Entity\Category;
use App\Facade\CategoryFacade;
use App\Factory\CategoryFactory;
use App\Form\Category\CategoryFormData;
use App\Service\CategoryUpdater;
use Doctrine\ORM\EntityManagerInterface;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class CategoryFacadeTest extends TestCase
{
    /** @var CategoryFacade */
    private $categoryFacade;

    /** @var EntityManagerInterface|m\Mock */
    private $entityManager;

    /** @var CategoryFactory|m\Mock */
    private $categoryFactory;

    /** @var CategoryUpdater|m\Mock */
    private $categoryUpdater;

    public function setUp(): void
    {
        $this->entityManager = m::spy(EntityManagerInterface::class);
        $this->categoryFactory = m::spy(CategoryFactory::class);
        $this->categoryUpdater = m::spy(CategoryUpdater::class);

        $this->categoryFacade = new CategoryFacade(
            $this->entityManager,
            $this->categoryFactory,
            $this->categoryUpdater
        );
    }

    public function testShouldCreateCategory(): void
    {
        $formData = m::mock(CategoryFormData::class);
        $category = m::mock(Category::class);

        $this->categoryFactory->shouldReceive('createFromFormData')
            ->once()
            ->with($formData)
            ->andReturn($category);

        $result = $this->categoryFacade->createCategory($formData);

        $this->assertInstanceOf(Category::class, $result);
        $this->entityManager->shouldHaveReceived('persist')
            ->with($category)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }

    public function testShouldUpdateCategory(): void
    {
        $formData = m::mock(CategoryFormData::class);
        $category = m::mock(Category::class);

        $this->categoryFacade->updateCategory($category, $formData);

        $this->categoryUpdater->shouldHaveReceived('updateCategory')
            ->with($category, $formData)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }

    public function testShouldDeleteCategory(): void
    {
        $category = m::mock(Category::class);

        $this->categoryFacade->deleteCategory($category);

        $this->entityManager->shouldHaveReceived('remove')
            ->with($category)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }
}

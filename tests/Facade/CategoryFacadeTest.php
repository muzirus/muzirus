<?php declare(strict_types=1);

namespace App\Tests\Facade;

use App\Entity\Category;
use App\Facade\CategoryFacade;
use App\Factory\CategoryFactoryInterface;
use App\Form\Category\CategoryFormData;
use App\Service\CategoryUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Mockery;
use PHPUnit\Framework\TestCase;

class CategoryFacadeTest extends TestCase
{
    /** @var CategoryFacade */
    private $categoryFacade;

    /** @var EntityManagerInterface|Mockery\MockInterface */
    private $entityManager;

    /** @var CategoryFactoryInterface|Mockery\MockInterface */
    private $categoryFactory;

    /** @var CategoryUpdaterInterface|Mockery\MockInterface */
    private $categoryUpdater;

    protected function setUp(): void
    {
        $this->entityManager = Mockery::spy(EntityManagerInterface::class);
        $this->categoryFactory = Mockery::spy(CategoryFactoryInterface::class);
        $this->categoryUpdater = Mockery::spy(CategoryUpdaterInterface::class);

        $this->categoryFacade = new CategoryFacade(
            $this->entityManager,
            $this->categoryFactory,
            $this->categoryUpdater
        );
    }

    public function testShouldCreateCategory(): void
    {
        $formData = Mockery::mock(CategoryFormData::class);
        $category = Mockery::mock(Category::class);

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
        $formData = Mockery::mock(CategoryFormData::class);
        $category = Mockery::mock(Category::class);

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
        $category = Mockery::mock(Category::class);

        $this->categoryFacade->deleteCategory($category);

        $this->entityManager->shouldHaveReceived('remove')
            ->with($category)
            ->once();
        $this->entityManager->shouldHaveReceived('flush')
            ->withNoArgs()
            ->once();
    }
}

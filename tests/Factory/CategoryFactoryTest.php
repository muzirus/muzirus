<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Factory\CategoryFactory;
use App\Form\Category\CategoryFormData;
use PHPUnit\Framework\TestCase;

class CategoryFactoryTest extends TestCase
{
    /** @var CategoryFactory */
    private $categoryFactory;

    protected function setUp(): void
    {
        $this->categoryFactory = new CategoryFactory();
    }

    public function testCreateFromFormData(): void
    {
        $title = 'title';
        $symbolFormData = new CategoryFormData();
        $symbolFormData->setTitle($title);

        $category = $this->categoryFactory->createFromFormData($symbolFormData);

        $this->assertSame($title, $category->getTitle());
    }
}

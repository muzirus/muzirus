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
        $titleInRussian = 'title in russian';
        $categoryFormData = new CategoryFormData();
        $categoryFormData->setTitle($title);
        $categoryFormData->setTitleInRussian($titleInRussian);

        $category = $this->categoryFactory->createFromFormData($categoryFormData);

        $this->assertSame($title, $category->getTitle());
        $this->assertSame($titleInRussian, $category->getTitleInRussian());
    }
}

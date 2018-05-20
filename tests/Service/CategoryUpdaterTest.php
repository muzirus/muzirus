<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\Category;
use App\Form\Category\CategoryFormData;
use App\Service\CategoryUpdater;
use PHPUnit\Framework\TestCase;

class CategoryUpdaterTest extends TestCase
{
    /** @var CategoryUpdater */
    private $categoryUpdater;

    protected function setUp(): void
    {
        $this->categoryUpdater = new CategoryUpdater();
    }

    public function testUpdateFromFormData(): void
    {
        $title = 'title';
        $formData = new CategoryFormData();
        $formData->setTitle($title);
        $category = new Category('bla');

        $this->categoryUpdater->updateCategory($category, $formData);

        $this->assertSame($title, $category->getTitle());
    }
}

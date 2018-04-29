<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\WordCategory;
use App\Form\Category\CategoryFormData;
use App\Service\CategoryUpdater;
use PHPUnit\Framework\TestCase;

class CategoryUpdaterTest extends TestCase
{
    /** @var CategoryUpdater */
    private $categoryUpdater;

    public function setUp(): void
    {
        $this->categoryUpdater = new CategoryUpdater();
    }

    public function testUpdateFromFormData(): void
    {
        $title = 'title';
        $formData = new CategoryFormData();
        $formData->setTitle($title);
        $category = new WordCategory('bla');

        $this->categoryUpdater->updateCategory($category, $formData);

        $this->assertSame($title, $category->getTitle());
    }
}

<?php declare(strict_types=1);

namespace App\Tests\Service;

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
        $titleInRussian = 'title in russian';
        $formData = new CategoryFormData();
        $formData->setTitle($title);
        $formData->setTitleInRussian($titleInRussian);

        $category = new Category('bla', 'bla in russian');

        $this->categoryUpdater->updateCategory($category, $formData);

        $this->assertSame($title, $category->getTitle());
        $this->assertSame($titleInRussian, $category->getTitleInRussian());
    }
}

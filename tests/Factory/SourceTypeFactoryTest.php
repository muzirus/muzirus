<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Factory\SourceTypeFactory;
use App\Form\SourceType\SourceTypeFormData;
use PHPUnit\Framework\TestCase;

class SourceTypeFactoryTest extends TestCase
{
    /** @var SourceTypeFactory */
    private $sourceTypeFactory;

    public function setUp(): void
    {
        $this->sourceTypeFactory = new SourceTypeFactory();
    }

    public function testCreateFromFormData(): void
    {
        $title = 'title';
        $sourceTypeFormData = new SourceTypeFormData();
        $sourceTypeFormData->setTitle($title);

        $sourceType = $this->sourceTypeFactory->createFromFormData($sourceTypeFormData);

        $this->assertSame($title, $sourceType->getTitle());
    }
}

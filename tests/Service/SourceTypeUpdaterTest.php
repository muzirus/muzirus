<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\SourceType;
use App\Form\SourceType\SourceTypeFormData;
use App\Service\SourceTypeUpdater;
use PHPUnit\Framework\TestCase;

class SourceTypeUpdaterTest extends TestCase
{
    /** @var SourceTypeUpdater */
    private $sourceTypeUpdater;

    protected function setUp(): void
    {
        $this->sourceTypeUpdater = new SourceTypeUpdater();
    }

    public function testUpdateFromFormData(): void
    {
        $title = 'title';
        $formData = new SourceTypeFormData();
        $formData->setTitle($title);
        $sourceType = new SourceType('bla');

        $this->sourceTypeUpdater->updateSourceType($sourceType, $formData);

        $this->assertSame($title, $sourceType->getTitle());
    }
}

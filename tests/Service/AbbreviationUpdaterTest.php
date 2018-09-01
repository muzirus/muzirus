<?php declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Abbreviation;
use App\Form\Abbreviation\AbbreviationFormData;
use App\Service\AbbreviationUpdater;
use PHPUnit\Framework\TestCase;

class AbbreviationUpdaterTest extends TestCase
{
    /** @var AbbreviationUpdater */
    private $abbreviationUpdater;

    protected function setUp(): void
    {
        $this->abbreviationUpdater = new AbbreviationUpdater();
    }

    public function testUpdateFromFormData(): void
    {
        $value = 'value';
        $title = 'title';
        $description = 'description';
        $formData = new AbbreviationFormData();
        $formData->setContent($value);
        $formData->setTitle($title);
        $formData->setDescription($description);
        $abbreviation = new Abbreviation('bla', 'ble', 'blu');

        $this->abbreviationUpdater->updateAbbreviation($abbreviation, $formData);

        $this->assertSame($value, $abbreviation->getContent());
        $this->assertSame($title, $abbreviation->getTitle());
        $this->assertSame($description, $abbreviation->getDescription());
    }
}

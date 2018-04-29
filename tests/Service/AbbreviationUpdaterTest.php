<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\Abbreviation;
use App\Form\Abbreviation\AbbreviationFormData;
use App\Service\AbbreviationUpdater;
use PHPUnit\Framework\TestCase;

class AbbreviationUpdaterTest extends TestCase
{
    /** @var AbbreviationUpdater */
    private $abbreviationUpdater;

    public function setUp(): void
    {
        $this->abbreviationUpdater = new AbbreviationUpdater();
    }

    public function testCreateFromFormData(): void
    {
        $abbreviation = new Abbreviation('bla', 'ble', 'blu');
        $value = 'value';
        $title = 'title';
        $description = 'description';
        $formData = new AbbreviationFormData();
        $formData->setContent($value);
        $formData->setTitle($title);
        $formData->setDescription($description);

        $this->abbreviationUpdater->updateAbbreviation($abbreviation, $formData);

        $this->assertSame($value, $abbreviation->getContent());
        $this->assertSame($title, $abbreviation->getTitle());
        $this->assertSame($description, $abbreviation->getDescription());
    }
}

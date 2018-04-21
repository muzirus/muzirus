<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Factory\AbbreviationFactory;
use App\Form\Abbreviation\AbbreviationFormData;
use PHPUnit\Framework\TestCase;

class AbbreviationFactoryTest extends TestCase
{
    /** @var AbbreviationFactory */
    private $abbreviationFactory;

    public function setUp(): void
    {
        $this->abbreviationFactory = new AbbreviationFactory();
    }

    public function testCreateFromFormData(): void
    {
        $value = 'value';
        $title = 'title';
        $description = 'description';
        $symbolFormData = new AbbreviationFormData();
        $symbolFormData->setContent($value);
        $symbolFormData->setTitle($title);
        $symbolFormData->setDescription($description);

        $abbreviation = $this->abbreviationFactory->createFromFormData($symbolFormData);

        $this->assertSame($value, $abbreviation->getContent());
        $this->assertSame($title, $abbreviation->getTitle());
        $this->assertSame($description, $abbreviation->getDescription());
    }
}

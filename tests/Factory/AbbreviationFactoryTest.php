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
        $abbreviationFormData = new AbbreviationFormData();
        $abbreviationFormData->setContent($value);
        $abbreviationFormData->setTitle($title);
        $abbreviationFormData->setDescription($description);

        $abbreviation = $this->abbreviationFactory->createFromFormData($abbreviationFormData);

        $this->assertSame($value, $abbreviation->getContent());
        $this->assertSame($title, $abbreviation->getTitle());
        $this->assertSame($description, $abbreviation->getDescription());
    }
}

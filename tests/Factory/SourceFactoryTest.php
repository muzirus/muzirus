<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\SourceType;
use App\Factory\SourceFactory;
use App\Form\Source\SourceFormData;
use PHPUnit\Framework\TestCase;

class SourceFactoryTest extends TestCase
{
    /** @var SourceFactory */
    private $sourceFactory;

    protected function setUp(): void
    {
        $this->sourceFactory = new SourceFactory();
    }

    public function testCreateFromFormData(): void
    {
        $title = 'title';
        $nameOfAuthor = 'author';
        $nameOfPublisher = 'publisher';
        $dateOfRelease = 'date';
        $placeOfRelease = 'place';
        $pagesCount = 9;
        $isbnCode = 'code';
        $note = 'note';
        $sourceType = new SourceType('title');

        $sourceFormData = new SourceFormData();
        $sourceFormData->setTitle($title);
        $sourceFormData->setType($sourceType);
        $sourceFormData->setNameOfAuthor($nameOfAuthor);
        $sourceFormData->setNameOfPublisher($nameOfPublisher);
        $sourceFormData->setDateOfRelease($dateOfRelease);
        $sourceFormData->setPlaceOfRelease($placeOfRelease);
        $sourceFormData->setPagesCount($pagesCount);
        $sourceFormData->setIsbnCode($isbnCode);
        $sourceFormData->setNote($note);

        $source = $this->sourceFactory->createFromFormData($sourceFormData);

        $this->assertSame($title, $source->getTitle());
        $this->assertSame($nameOfAuthor, $source->getNameOfAuthor());
        $this->assertSame($nameOfPublisher, $source->getNameOfPublisher());
        $this->assertSame($dateOfRelease, $source->getDateOfRelease());
        $this->assertSame($placeOfRelease, $source->getPlaceOfRelease());
        $this->assertSame($pagesCount, $source->getPagesCount());
        $this->assertSame($isbnCode, $source->getIsbnCode());
        $this->assertSame($note, $source->getNote());
        $this->assertSame($sourceType, $source->getType());
    }
}

<?php declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Source;
use App\Entity\SourceType;
use App\Form\Source\SourceFormData;
use App\Service\SourceUpdater;
use PHPUnit\Framework\TestCase;

class SourceUpdaterTest extends TestCase
{
    /** @var SourceUpdater */
    private $sourceUpdater;

    protected function setUp(): void
    {
        $this->sourceUpdater = new SourceUpdater();
    }

    public function testUpdateFromFormData(): void
    {
        $title = 'title';
        $type = new SourceType('title');
        $nameOfAuthor = 'name of author';
        $nameOfPublisher = 'name of publisher';
        $dateOfRelease = 'date of release';
        $placeOfRelease = 'place of release';
        $pagesCount = 1;
        $isbnCode = '123';
        $note = 'note';

        $formData = new SourceFormData();
        $formData->setTitle($title);
        $formData->setType($type);
        $formData->setNameOfAuthor($nameOfAuthor);
        $formData->setNameOfPublisher($nameOfPublisher);
        $formData->setDateOfRelease($dateOfRelease);
        $formData->setPlaceOfRelease($placeOfRelease);
        $formData->setPagesCount($pagesCount);
        $formData->setIsbnCode($isbnCode);
        $formData->setNote($note);

        $source = new Source(
            'original title',
            new SourceType('original source type title')
        );

        $this->sourceUpdater->updateSource($source, $formData);

        $this->assertSame($title, $source->getTitle());
        $this->assertSame($type, $source->getType());
        $this->assertSame($nameOfAuthor, $source->getNameOfAuthor());
        $this->assertSame($nameOfPublisher, $source->getNameOfPublisher());
        $this->assertSame($dateOfRelease, $source->getDateOfRelease());
        $this->assertSame($placeOfRelease, $source->getPlaceOfRelease());
        $this->assertSame($pagesCount, $source->getPagesCount());
        $this->assertSame($isbnCode, $source->getIsbnCode());
        $this->assertSame($note, $source->getNote());
    }
}

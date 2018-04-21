<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\CzechWord;
use App\Entity\RussianWord;
use App\Factory\TranslationFactory;
use App\Form\Translation\TranslationFormData;
use Mockery;
use PHPUnit\Framework\TestCase;

class TranslationFactoryTest extends TestCase
{
    /** @var TranslationFactory */
    private $translationFactory;

    public function setUp(): void
    {
        $this->translationFactory = new TranslationFactory();
    }

    public function testCreateFromFormData(): void
    {
        $czechWord = Mockery::mock(CzechWord::class);
        $russianWord = Mockery::mock(RussianWord::class);
        $czechWordNote = 'czech word note';
        $russianWordNote = 'russian word note';
        $link = 'link';

        $translationFormData = new TranslationFormData();
        $translationFormData->setCzechWord($czechWord);
        $translationFormData->setRussianWord($russianWord);
        $translationFormData->setCzechWordNote($czechWordNote);
        $translationFormData->setRussianWordNote($russianWordNote);
        $translationFormData->setLink($link);

        $symbol = $this->translationFactory->createFromFormData($translationFormData);

        $this->assertSame($czechWord, $symbol->getCzechWord());
        $this->assertSame($russianWord, $symbol->getRussianWord());
        $this->assertSame($czechWordNote, $symbol->getCzechWordNote());
        $this->assertSame($russianWordNote, $symbol->getRussianWordNote());
        $this->assertSame($link, $symbol->getLink());
    }
}

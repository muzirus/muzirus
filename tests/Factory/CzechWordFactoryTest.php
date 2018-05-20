<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\Category;
use App\Entity\CzechWord;
use App\Entity\Source;
use App\Factory\CzechWordFactory;
use App\Form\Word\CzechWordFormData;
use Mockery;
use PHPUnit\Framework\TestCase;

class CzechWordFactoryTest extends TestCase
{
    /** @var CzechWordFactory */
    private $czechWordFactory;

    protected function setUp(): void
    {
        $this->czechWordFactory = new CzechWordFactory();
    }

    public function testCreateFromFormData(): void
    {
        $content = 'content';
        $categories = [
            Mockery::mock(Category::class),
            Mockery::mock(Category::class),
        ];
        $sources = [
            Mockery::mock(Source::class),
        ];
        $languageNotePronunciation = 'language note pronunciation';
        $languageNoteInflection = 'language note inflection';
        $languageNoteExceptionToInflection = 'language note exception to inflection';
        $languageNoteType = CzechWord::TYPE_NOUN;
        $languageNoteGender = CzechWord::GENDER_MASCULINE;
        $explanation = 'explanation';
        $explanationSourceInfo = 'explanation source info';
        $explanationSourceDate = 'explanation source date';
        $note = 'note';
        $statusLight = CzechWord::STATUS_LIGHT_EQUIVALENTS_NOT_FOUND;

        $czechWordFormData = new CzechWordFormData();
        $czechWordFormData->setContent($content);
        $czechWordFormData->setCategories($categories);
        $czechWordFormData->setSources($sources);
        $czechWordFormData->setLanguageNotePronunciation($languageNotePronunciation);
        $czechWordFormData->setLanguageNoteInflection($languageNoteInflection);
        $czechWordFormData->setLanguageNoteExceptionToInflection($languageNoteExceptionToInflection);
        $czechWordFormData->setLanguageNoteType($languageNoteType);
        $czechWordFormData->setLanguageNoteGender($languageNoteGender);
        $czechWordFormData->setExplanation($explanation);
        $czechWordFormData->setExplanationSourceInfo($explanationSourceInfo);
        $czechWordFormData->setExplanationSourceDate($explanationSourceDate);
        $czechWordFormData->setNote($note);
        $czechWordFormData->setStatusLight($statusLight);

        $czechWord = $this->czechWordFactory->createFromFormData($czechWordFormData);

        $this->assertSame($content, $czechWord->getContent());
        $this->assertSame($categories, $czechWord->getCategories());
        $this->assertSame($sources, $czechWord->getSources());
        $this->assertSame($languageNotePronunciation, $czechWord->getLanguageNotePronunciation());
        $this->assertSame($languageNoteInflection, $czechWord->getLanguageNoteInflection());
        $this->assertSame($languageNoteExceptionToInflection, $czechWord->getLanguageNoteExceptionToInflection());
        $this->assertSame($languageNoteType, $czechWord->getLanguageNoteType());
        $this->assertSame($languageNoteGender, $czechWord->getLanguageNoteGender());
        $this->assertSame($explanation, $czechWord->getExplanation());
        $this->assertSame($explanationSourceInfo, $czechWord->getExplanationSourceInfo());
        $this->assertSame($explanationSourceDate, $czechWord->getExplanationSourceDate());
        $this->assertSame($note, $czechWord->getNote());
        $this->assertSame($statusLight, $czechWord->getStatusLight());
    }
}

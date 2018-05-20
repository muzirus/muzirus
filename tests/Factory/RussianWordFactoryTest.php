<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\Category;
use App\Entity\RussianWord;
use App\Entity\Source;
use App\Factory\RussianWordFactory;
use App\Form\Word\RussianWordFormData;
use Mockery;
use PHPUnit\Framework\TestCase;

class RussianWordFactoryTest extends TestCase
{
    /** @var RussianWordFactory */
    private $russianWordFactory;

    protected function setUp(): void
    {
        $this->russianWordFactory = new RussianWordFactory();
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
        $contentWithAccent = 'content with accent';
        $languageNotePronunciation = 'language note pronunciation';
        $languageNoteInflection = 'language note inflection';
        $languageNoteExceptionToInflection = 'language note exception to inflection';
        $languageNoteType = RussianWord::TYPE_NOUN;
        $languageNoteGender = RussianWord::GENDER_MASCULINE;
        $explanation = 'explanation';
        $explanationSourceInfo = 'explanation source info';
        $explanationSourceDate = 'explanation source date';
        $note = 'note';
        $statusLight = RussianWord::STATUS_LIGHT_EQUIVALENTS_NOT_FOUND;

        $russianWordFormData = new RussianWordFormData();
        $russianWordFormData->setContent($content);
        $russianWordFormData->setCategories($categories);
        $russianWordFormData->setSources($sources);
        $russianWordFormData->setContentWithAccent($contentWithAccent);
        $russianWordFormData->setLanguageNotePronunciation($languageNotePronunciation);
        $russianWordFormData->setLanguageNoteInflection($languageNoteInflection);
        $russianWordFormData->setLanguageNoteExceptionToInflection($languageNoteExceptionToInflection);
        $russianWordFormData->setLanguageNoteType($languageNoteType);
        $russianWordFormData->setLanguageNoteGender($languageNoteGender);
        $russianWordFormData->setExplanation($explanation);
        $russianWordFormData->setExplanationSourceInfo($explanationSourceInfo);
        $russianWordFormData->setExplanationSourceDate($explanationSourceDate);
        $russianWordFormData->setNote($note);
        $russianWordFormData->setStatusLight($statusLight);

        $russianWord = $this->russianWordFactory->createFromFormData($russianWordFormData);

        $this->assertSame($content, $russianWord->getContent());
        $this->assertSame($categories, $russianWord->getCategories());
        $this->assertSame($sources, $russianWord->getSources());
        $this->assertSame($contentWithAccent, $russianWord->getContentWithAccent());
        $this->assertSame($languageNotePronunciation, $russianWord->getLanguageNotePronunciation());
        $this->assertSame($languageNoteInflection, $russianWord->getLanguageNoteInflection());
        $this->assertSame($languageNoteExceptionToInflection, $russianWord->getLanguageNoteExceptionToInflection());
        $this->assertSame($languageNoteType, $russianWord->getLanguageNoteType());
        $this->assertSame($languageNoteGender, $russianWord->getLanguageNoteGender());
        $this->assertSame($explanation, $russianWord->getExplanation());
        $this->assertSame($explanationSourceInfo, $russianWord->getExplanationSourceInfo());
        $this->assertSame($explanationSourceDate, $russianWord->getExplanationSourceDate());
        $this->assertSame($note, $russianWord->getNote());
        $this->assertSame($statusLight, $russianWord->getStatusLight());
    }
}

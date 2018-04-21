<?php declare(strict_types=1);

namespace App\Tests\Factory;

use App\Entity\Translation;
use App\Factory\TranslationExampleFactory;
use App\Form\TranslationExample\TranslationExampleFormData;
use Mockery;
use PHPUnit\Framework\TestCase;

class TranslationExampleFactoryTest extends TestCase
{
    /** @var TranslationExampleFactory */
    private $translationExampleFactory;

    public function setUp(): void
    {
        $this->translationExampleFactory = new TranslationExampleFactory();
    }

    public function testCreateFromFormData(): void
    {
        $translation = Mockery::mock(Translation::class);
        $czechWordSentence = 'czech word sentence';
        $russianWordSentence = 'russian word sentence';
        $isHidden = false;

        $translationExampleFormData = new TranslationExampleFormData($translation);
        $translationExampleFormData->setCzechWordSentence($czechWordSentence);
        $translationExampleFormData->setRussianWordSentence($russianWordSentence);
        $translationExampleFormData->setHidden($isHidden);

        $translationExample = $this->translationExampleFactory->createFromFormData($translationExampleFormData);

        $this->assertSame($translation, $translationExample->getTranslation());
        $this->assertSame($czechWordSentence, $translationExample->getCzechWordSentence());
        $this->assertSame($russianWordSentence, $translationExample->getRussianWordSentence());
        $this->assertSame($isHidden, $translationExample->isHidden());
    }
}

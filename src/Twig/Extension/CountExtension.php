<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Repository\CountRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CountExtension extends AbstractExtension
{
    /** @var CountRepository */
    private $countRepository;

    public function __construct(CountRepository $countRepository)
    {
        $this->countRepository = $countRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('count_translations', function (): int {
                return $this->countRepository->countTranslations();
            }),
            new TwigFunction('count_translation_examples', function (): int {
                return $this->countRepository->countTranslationExamples();
            }),
            new TwigFunction('count_czech_words', function (): int {
                return $this->countRepository->countCzechWords();
            }),
            new TwigFunction('count_russian_words', function (): int {
                return $this->countRepository->countRussianWords();
            }),
        ];
    }
}

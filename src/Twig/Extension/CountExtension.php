<?php

namespace App\Twig\Extension;

use App\Repository\CountRepository;

class CountExtension extends \Twig_Extension
{
    /**
     * @var CountRepository
     */
    private $countRepository;

    public function __construct(CountRepository $countRepository)
    {
        $this->countRepository = $countRepository;
    }

    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('count_translations', function () {
                return $this->countRepository->countTranslations();
            }),
            new \Twig_SimpleFunction('count_translation_examples', function () {
                return $this->countRepository->countTranslationExamples();
            }),
            new \Twig_SimpleFunction('count_czech_words', function () {
                return $this->countRepository->countCzechWords();
            }),
            new \Twig_SimpleFunction('count_russian_words', function () {
                return $this->countRepository->countRussianWords();
            }),
        ];
    }
}

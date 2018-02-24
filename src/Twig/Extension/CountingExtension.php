<?php

namespace App\Twig\Extension;

use App\Service\CountingService;

class CountingExtension extends \Twig_Extension
{
    /**
     * @var CountingService
     */
    private $countingService;

    public function __construct(CountingService $countingService)
    {
        $this->countingService = $countingService;
    }

    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('count_translations', function () {
                return $this->countingService->getTranslationsCount();
            }),
            new \Twig_SimpleFunction('count_translation_examples', function () {
                return $this->countingService->getTranslationExamplesCount();
            }),
            new \Twig_SimpleFunction('count_czech_words', function () {
                return $this->countingService->getCzechWordsCount();
            }),
            new \Twig_SimpleFunction('count_russian_words', function () {
                return $this->countingService->getRussianWordsCount();
            }),
        ];
    }
}

<?php

namespace App\Service;

use App\Repository\CzechWordRepository;
use App\Repository\RussianWordRepository;
use App\Repository\TranslationExampleRepository;
use App\Repository\TranslationRepository;

class CountingService
{
    /**
     * @var int|null
     */
    private $czechWordsCount;

    /**
     * @var int|null
     */
    private $russianWordsCount;

    /**
     * @var int|null
     */
    private $translationsCount;

    /**
     * @var int|null
     */
    private $translationExamplesCount;

    /**
     * @var RussianWordRepository
     */
    private $russianWordRepository;

    /**
     * @var CzechWordRepository
     */
    private $czechWordRepository;

    /**
     * @var TranslationRepository
     */
    private $translationRepository;

    /**
     * @var TranslationExampleRepository
     */
    private $translationExampleRepository;

    public function __construct(
        RussianWordRepository $russianWordRepository,
        CzechWordRepository $czechWordRepository,
        TranslationRepository $translationRepository,
        TranslationExampleRepository $translationExampleRepository
    )
    {
        $this->russianWordRepository = $russianWordRepository;
        $this->czechWordRepository = $czechWordRepository;
        $this->translationRepository = $translationRepository;
        $this->translationExampleRepository = $translationExampleRepository;
    }

    public function getRussianWordsCount(): int
    {
        if ($this->russianWordsCount === null) {
            $this->russianWordsCount = $this->russianWordRepository->count([]);
        }

        return $this->russianWordsCount;
    }

    public function getCzechWordsCount(): int
    {
        if ($this->czechWordsCount === null) {
            $this->czechWordsCount = $this->czechWordRepository->count([]);
        }

        return $this->czechWordsCount;
    }

    public function getTranslationsCount(): int
    {
        if ($this->translationsCount === null) {
            $this->translationsCount = $this->translationRepository->count([]);
        }

        return $this->translationsCount;
    }

    public function getTranslationExamplesCount(): int
    {
        if ($this->translationExamplesCount === null) {
            $this->translationExamplesCount = $this->translationExampleRepository->count([]);
        }

        return $this->translationExamplesCount;
    }
}

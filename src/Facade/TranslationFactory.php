<?php

namespace App\Facade;

use App\Entity\Translation;
use App\Entity\TranslationInterface;
use App\Form\Translation\TranslationFormData;
use App\Repository\CzechWordRepository;
use App\Repository\RussianWordRepository;

class TranslationFactory
{
    /**
     * @var CzechWordRepository
     */
    private $czechWordRepository;

    /**
     * @var RussianWordRepository
     */
    private $russianWordRepository;

    public function __construct(CzechWordRepository $czechWordRepository, RussianWordRepository $russianWordRepository)
    {
        $this->czechWordRepository = $czechWordRepository;
        $this->russianWordRepository = $russianWordRepository;
    }

    public function createTranslationFromFormData(TranslationFormData $formData): TranslationInterface
    {
        $czechWord = $this->czechWordRepository->getOne($formData->getCzechWordId());
        $russianWord = $this->russianWordRepository->getOne($formData->getRussianWordId());

        $translation = new Translation($russianWord, $czechWord);

        $translation->setCzechWordNote($formData->getCzechWordNote());
        $translation->setRussianWordNote($formData->getRussianWordNote());

        return $translation;
    }
}

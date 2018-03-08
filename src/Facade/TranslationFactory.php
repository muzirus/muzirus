<?php

namespace App\Facade;

use App\Entity\Translation;
use App\Entity\TranslationInterface;
use App\Form\Translation\CreateTranslationFormDataInterface;
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

    public function createTranslationFromFormData(CreateTranslationFormDataInterface $formData): TranslationInterface
    {
        $translation = new Translation(
            $formData->getRussianWord(),
            $formData->getCzechWord()
        );

        $translation->setCzechWordNote($formData->getCzechWordNote());
        $translation->setRussianWordNote($formData->getRussianWordNote());

        return $translation;
    }
}

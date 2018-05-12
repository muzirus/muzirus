<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\RussianWordInterface;
use App\Form\Word\RussianWordFormDataInterface;

interface RussianWordFacadeInterface
{
    public function createRussianWord(RussianWordFormDataInterface $formData): RussianWordInterface;

    public function updateRussianWord(RussianWordInterface $word, RussianWordFormDataInterface $formData): void;

    public function deleteRussianWord(RussianWordInterface $word): void;
}

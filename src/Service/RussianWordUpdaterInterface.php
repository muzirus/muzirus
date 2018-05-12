<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\RussianWordInterface;
use App\Form\Word\RussianWordFormDataInterface;

interface RussianWordUpdaterInterface
{
    public function updateRussianWord(RussianWordInterface $word, RussianWordFormDataInterface $formData): void;
}

<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\CzechWordInterface;
use App\Form\Word\CzechWordFormDataInterface;

interface CzechWordUpdaterInterface
{
    public function updateCzechWord(CzechWordInterface $word, CzechWordFormDataInterface $formData): void;
}

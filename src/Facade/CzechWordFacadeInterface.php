<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\CzechWordInterface;
use App\Form\Word\CzechWordFormDataInterface;

interface CzechWordFacadeInterface
{
    public function createCzechWord(CzechWordFormDataInterface $formData): CzechWordInterface;

    public function updateCzechWord(CzechWordInterface $word, CzechWordFormDataInterface $formData): void;

    public function deleteCzechWord(CzechWordInterface $word): void;
}

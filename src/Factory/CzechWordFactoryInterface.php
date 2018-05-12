<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\CzechWordInterface;
use App\Form\Word\CzechWordFormDataInterface;

interface CzechWordFactoryInterface
{
    public function createFromFormData(CzechWordFormDataInterface $formData): CzechWordInterface;
}

<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\RussianWordInterface;
use App\Form\Word\RussianWordFormDataInterface;

interface RussianWordFactoryInterface
{
    public function createFromFormData(RussianWordFormDataInterface $formData): RussianWordInterface;
}

<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\User;
use App\Entity\UserInterface;
use App\Form\User\UserFormDataInterface;

class UserFactory
{
    public function createFromFormData(UserFormDataInterface $formData): UserInterface
    {
        return new User($formData->getName(), $formData->getEmail());
    }
}

<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\UserInterface;
use App\Form\User\UserFormDataInterface;

class UserUpdater implements UserUpdaterInterface
{
    public function updateUser(UserInterface $user, UserFormDataInterface $formData): void
    {
        $user->setEmail($formData->getEmail());
        $user->setName($formData->getName());
    }
}

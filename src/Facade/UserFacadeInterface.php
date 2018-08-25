<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\UserInterface;
use App\Form\User\UserFormDataInterface;

interface UserFacadeInterface
{
    public function createUser(UserFormDataInterface $formData): UserInterface;

    public function updateUser(UserInterface $user, UserFormDataInterface $formData): void;

    public function deleteUser(UserInterface $user): void;
}

<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\UserInterface;
use App\Form\User\UserFormDataInterface;

interface UserUpdaterInterface
{
    public function updateUser(UserInterface $user, UserFormDataInterface $formData): void;
}

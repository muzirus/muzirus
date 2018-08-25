<?php declare(strict_types=1);

namespace App\Form\User;

interface UserFormDataInterface
{
    public function getName(): string;

    public function setName(string $name): void;

    public function getEmail(): string;

    public function setEmail(string $email): void;
}

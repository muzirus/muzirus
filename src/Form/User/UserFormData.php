<?php declare(strict_types=1);

namespace App\Form\User;

use App\Entity\UserInterface;

class UserFormData implements UserFormDataInterface
{
    /** @var string */
    private $name = '';

    /** @var string */
    private $email = '';

    public static function createFromUser(UserInterface $user): self
    {
        $formData = new self();

        $formData->setEmail($user->getEmail());
        $formData->setName($user->getName());

        return $formData;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}

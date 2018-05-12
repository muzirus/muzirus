<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\TimestampableInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

interface UserInterface extends \Serializable, SymfonyUserInterface, TimestampableInterface
{
    public function __toString(): string;

    public function getId(): string;

    public function getName(): string;

    public function setName(string $name): void;

    public function getEmail(): string;

    public function setEmail(string $email): void;

    public function getPasswordHash(): string;

    public function setPasswordHash(string $passwordHash): void;

    public function setPassword(string $password, int $cost = 10): void;

    public function verifyPassword(string $password): bool;

    public function isAdmin(): bool;

    public function setAdmin(bool $admin): void;

    public function isBanned(): bool;

    public function setBanned(bool $banned): void;
}

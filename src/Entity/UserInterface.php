<?php declare(strict_types=1);

namespace App\Entity;

use App\Entity\Able\Timestampable;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

interface UserInterface extends \Serializable, SymfonyUserInterface, Timestampable
{
    public function __toString(): string;

    public function getId(): int;

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

    public function getLocale(): string;

    public function setLocale(string $locale): void;

    public function getPasswordRecoveryKey(): ?string;

    public function setPasswordRecoveryKey(string $passwordRecoveryKey = null): void;

    public function removePasswordRecoveryKey(): void;

    public function getPasswordRecoveryKeyExpireDT(): ?\DateTime;

    public function setPasswordRecoveryKeyExpireDT(\DateTime $passwordRecoveryKeyExpireDT = null): void;

    public function removePasswordRecoveryKeyExpireDT(): void;
}

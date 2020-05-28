<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    use TimestampsTrait;

    //-------------------------------------------------------------------------

    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", name="name")
     */
    private string $name = '';

    /**
     * @ORM\Column(type="string", name="email", unique=true)
     */
    private string $email = '';

    /**
     * @ORM\Column(type="string", name="password_hash")
     */
    private string $passwordHash = '';

    /**
     * @ORM\Column(type="boolean", name="admin", options={"default":false})
     */
    private bool $admin = false;

    /**
     * @ORM\Column(type="boolean", name="banned", options={"default":false})
     */
    private bool $banned = false;

    //-------------------------------------------------------------------------

    public function __construct(string $name, string $email, bool $admin = false)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->setAdmin($admin);
    }

    public function __toString(): string
    {
        return $this->getName();
    }

    //-------------------------------------------------------------------------

    public function getId(): string
    {
        return $this->id;
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

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    public function setPassword(string $password, int $cost = 13): void
    {
        $options = ['cost' => $cost];

        $passwordHash = (string) password_hash($password, PASSWORD_BCRYPT, $options);

        $this->setPasswordHash($passwordHash);
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->getPasswordHash());
    }

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): void
    {
        $this->admin = $admin;
    }

    public function isBanned(): bool
    {
        return $this->banned;
    }

    public function setBanned(bool $banned): void
    {
        $this->banned = $banned;
    }

    //-------------------------------------------------------------------------

    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->email,
            $this->passwordHash,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized): void
    {
        [
            $this->id,
            $this->email,
            $this->passwordHash,
        ] = unserialize($serialized, ['allowed_classes' => [self::class]]);
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        $roles = [
            self::ROLE_USER,
        ];

        if ($this->isAdmin()) {
            $roles[] = self::ROLE_ADMIN;
        }

        return $roles;
    }

    public function getPassword(): string
    {
        return $this->passwordHash;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
    }
}

<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements UserInterface
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    public const LOCALES = [
        'cs_CZ' => 'Česky',
        'en_GB' => 'English',
        'ru_RU' => 'Русский',
        'sk_SK' => 'Slovensky',
    ];

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="name")
     * @var string
     */
    private $name = '';

    /**
     * @ORM\Column(type="string", name="email", unique=true)
     * @var string
     */
    private $email = '';

    /**
     * @ORM\Column(type="string", name="password_hash")
     * @var string
     */
    private $passwordHash = '';

    /**
     * @ORM\Column(type="boolean", name="admin", options={"default":false})
     * @var bool
     */
    private $admin = false;

    /**
     * @ORM\Column(type="boolean", name="banned", options={"default":false})
     * @var bool
     */
    private $banned = false;

    /**
     * @ORM\Column(type="string", name="locale")
     * @var string
     */
    private $locale = 'cs_CZ';

    /**
     * @ORM\Column(type="string", name="password_recovery_key", nullable=true)
     * @var string|null
     */
    private $passwordRecoveryKey = null;

    /**
     * @ORM\Column(type="datetime", name="password_recovery_key_expire_dt", nullable=true)
     * @var \DateTime|null
     */
    private $passwordRecoveryKeyExpireDT = null;

    /**
     * @ORM\Column(type="datetime", name="created_at", options={"default":"CURRENT_TIMESTAMP"})
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", options={"default":"CURRENT_TIMESTAMP"})
     * @var \DateTime
     */
    private $updatedAt;

    //-------------------------------------------------------------------------

    public function __construct(string $name, string $email, bool $admin = false)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->setAdmin($admin);

        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
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

        $passwordHash = password_hash($password, PASSWORD_BCRYPT, $options);

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

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        if (array_key_exists($locale, self::LOCALES)) {
            $this->locale = $locale;
        }
    }

    public function getPasswordRecoveryKey(): ?string
    {
        return $this->passwordRecoveryKey;
    }

    public function setPasswordRecoveryKey(string $passwordRecoveryKey = null): void
    {
        $this->passwordRecoveryKey = $passwordRecoveryKey;
    }

    public function removePasswordRecoveryKey(): void
    {
        $this->passwordRecoveryKey = null;
    }

    public function getPasswordRecoveryKeyExpireDT(): ?\DateTime
    {
        return $this->passwordRecoveryKeyExpireDT;
    }

    public function setPasswordRecoveryKeyExpireDT(\DateTime $passwordRecoveryKeyExpireDT = null): void
    {
        $this->passwordRecoveryKeyExpireDT = $passwordRecoveryKeyExpireDT;
    }

    public function removePasswordRecoveryKeyExpireDT(): void
    {
        $this->passwordRecoveryKeyExpireDT = null;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getCreatedAtFormat(string $format = 'Y-m-d H:i'): string
    {
        return $this->getCreatedAt()->format($format);
    }

    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    public function getUpdatedAtFormat(string $format = 'Y-m-d H:i'): string
    {
        return $this->getUpdatedAt()->format($format);
    }

    //-------------------------------------------------------------------------

    /**
     * @ORM\PreUpdate()
     */
    public function _timestampsPreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }

    //-------------------------------------------------------------------------

    /**
     * String representation of object
     *
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize(): string
    {
        return serialize([
            $this->id,
            $this->email,
            $this->passwordHash,
        ]);
    }

    /**
     * Constructs the object
     *
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @since 5.1.0
     */
    public function unserialize($serialized): void
    {
        [
            $this->id,
            $this->email,
            $this->passwordHash,
        ] = unserialize($serialized);
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles(): array
    {
        $roles = [];
        $roles[] = self::ROLE_USER;

        if ($this->isAdmin()) {
            $roles[] = self::ROLE_ADMIN;
        }

        return $roles;
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword(): string
    {
        return $this->passwordHash;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername(): string
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials(): void
    {
    }
}

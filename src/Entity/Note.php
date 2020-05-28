<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="notes")
 * @ORM\HasLifecycleCallbacks()
 */
class Note implements NoteInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     */
    private string $id;

    /**
     * Owning side.
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private UserInterface $user;

    /**
     * @ORM\Column(type="text", name="content")
     */
    private string $content;

    /**
     * @ORM\Column(type="datetime", name="created_at", options={"default":"CURRENT_TIMESTAMP"})
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", options={"default":"CURRENT_TIMESTAMP"})
     */
    private \DateTimeInterface $updatedAt;

    //-------------------------------------------------------------------------

    public function __construct(UserInterface $user, string $content)
    {
        $this->user = $user;
        $this->setContent($content);

        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function __toString(): string
    {
        return $this->getContent();
    }

    //-------------------------------------------------------------------------

    public function getId(): string
    {
        return $this->id;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getCreatedAtFormat(string $format = 'Y-m-d H:i'): string
    {
        return $this->getCreatedAt()->format($format);
    }

    public function getUpdatedAt(): \DateTimeInterface
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
}

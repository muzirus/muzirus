<?php declare(strict_types=1);

namespace App\EntityTrait;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\HasLifecycleCallbacks()
 */
trait TimestampsTrait
{
    /**
     * @ORM\Column(type="datetime", name="created_at", options={"default":"CURRENT_TIMESTAMP"})
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", options={"default":"CURRENT_TIMESTAMP"})
     */
    private \DateTimeInterface $updatedAt;

    //-------------------------------------------------------------------------

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    //-------------------------------------------------------------------------

    /**
     * @ORM\PrePersist()
     */
    public function _timestampsPrePersist(): void
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function _timestampsPreUpdate(): void
    {
        $this->updatedAt = new \DateTime();
    }
}

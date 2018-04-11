<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\Timestamps;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SourceTypeRepository")
 * @ORM\Table(name="source_types")
 * @ORM\HasLifecycleCallbacks()
 */
class SourceType implements SourceTypeInterface
{
    use Timestamps;

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="title", unique=true)
     * @var string
     */
    private $title = '';

    //-------------------------------------------------------------------------

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function __toString(): string
    {
        return $this->getTitle();
    }

    //-------------------------------------------------------------------------

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}

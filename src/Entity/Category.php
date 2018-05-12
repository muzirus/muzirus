<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="word_categories")
 * @ORM\HasLifecycleCallbacks()
 */
class Category implements CategoryInterface
{
    use TimestampsTrait;

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="title")
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

    public function getId(): string
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

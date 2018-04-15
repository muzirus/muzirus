<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\Timestamps;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\Table(name="posts")
 * @ORM\HasLifecycleCallbacks()
 */
class Post implements PostInterface
{
    use Timestamps;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(type="string", name="slug", unique=true)
     * @var string
     */
    private $slug;

    /**
     * @ORM\Column(type="string", name="title")
     * @var string
     */
    private $title;

    /**
     * @ORM\Column(type="text", name="content")
     * @var string
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", onDelete="SET NULL")
     * @var UserInterface|null
     */
    private $author;

    public function __construct(string $slug, string $title, string $content, ?UserInterface $author = null)
    {
        $this->slug = $slug;
        $this->setTitle($title);
        $this->setContent($content);
        $this->author = $author;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function hasAuthor(): bool
    {
        return $this->author instanceof UserInterface;
    }

    public function getAuthor(): UserInterface
    {
        return $this->author;
    }
}

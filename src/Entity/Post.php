<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\Table(name="posts")
 * @ORM\HasLifecycleCallbacks()
 */
class Post implements PostInterface
{
    use TimestampsTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", name="slug", unique=true)
     */
    private string $slug;

    /**
     * @ORM\Column(type="string", name="title")
     */
    private string $title;

    /**
     * @ORM\Column(type="string", name="title_in_russian")
     */
    private string $titleInRussian;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private ?UserInterface $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostRevision", mappedBy="post")
     * @ORM\OrderBy({"createdAt": "ASC"})
     * @var Collection<PostRevisionInterface>
     */
    private Collection $revisions;

    public function __construct(string $slug, string $title, string $titleInRussian, ?UserInterface $author = null)
    {
        $this->slug = $slug;
        $this->setTitle($title);
        $this->setTitleInRussian($titleInRussian);
        $this->author = $author;
        $this->revisions = new ArrayCollection();
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

    public function getTitleInRussian(): string
    {
        return $this->titleInRussian;
    }

    public function setTitleInRussian(string $titleInRussian): void
    {
        $this->titleInRussian = $titleInRussian;
    }

    public function getContent(): string
    {
        return $this->getLastRevision()->getContent();
    }

    public function getContentInRussian(): string
    {
        return $this->getLastRevision()->getContentInRussian();
    }

    public function hasAuthor(): bool
    {
        return $this->author instanceof UserInterface;
    }

    public function getAuthor(): ?UserInterface
    {
        return $this->author;
    }

    public function getLastRevision(): PostRevisionInterface
    {
        return $this->revisions->last();
    }
}

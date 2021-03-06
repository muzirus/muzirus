<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="post_revisions")
 * @ORM\HasLifecycleCallbacks()
 */
class PostRevision implements PostRevisionInterface
{
    use TimestampsTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     */
    private string $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="revisions")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id", nullable=false)
     */
    private PostInterface $post;

    /**
     * @ORM\Column(type="text", name="content")
     */
    private string $content;

    /**
     * @ORM\Column(type="text", name="content_in_russian")
     */
    private string $contentInRussian;

    public function __construct(PostInterface $post, string $content, string $contentInRussian)
    {
        $this->post = $post;
        $this->content = $content;
        $this->contentInRussian = $contentInRussian;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getContentInRussian(): string
    {
        return $this->contentInRussian;
    }
}

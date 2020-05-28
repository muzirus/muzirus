<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 * @ORM\Table(name="messages")
 * @ORM\HasLifecycleCallbacks()
 */
class Message implements MessageInterface
{
    use TimestampsTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", name="email")
     */
    private string $email;

    /**
     * @ORM\Column(type="text", name="content")
     */
    private string $content;

    public function __construct(string $email, string $content)
    {
        $this->email = $email;
        $this->content = $content;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}

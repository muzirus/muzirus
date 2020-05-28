<?php declare(strict_types=1);

namespace App\Entity;

use App\EntityTrait\TimestampsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AbbreviationRepository")
 * @ORM\Table(name="abbreviations")
 * @ORM\HasLifecycleCallbacks()
 */
class Abbreviation implements AbbreviationInterface
{
    use TimestampsTrait;

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     */
    private string $id;

    /**
     * @ORM\Column(type="string", name="title")
     */
    private string $title = '';

    /**
     * @ORM\Column(type="string", name="content", unique=true)
     */
    private string $content = '';

    /**
     * @ORM\Column(type="string", name="description")
     */
    private string $description = '';

    //-------------------------------------------------------------------------

    public function __construct(string $title, string $content, string $description = '')
    {
        $this->setTitle($title);
        $this->setContent($content);
        $this->setDescription($description);
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}

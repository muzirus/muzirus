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

    /**
     * @ORM\Column(type="string", name="title_in_russian", options={"default": ""})
     * @var string
     */
    private $titleInRussian = '';

    //-------------------------------------------------------------------------

    public function __construct(string $title, string $titleInRussian)
    {
        $this->title = $title;
        $this->titleInRussian = $titleInRussian;
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

    public function getTitleInRussian(): string
    {
        return $this->titleInRussian;
    }

    public function setTitleInRussian(string $titleInRussian): void
    {
        $this->titleInRussian = $titleInRussian;
    }
}

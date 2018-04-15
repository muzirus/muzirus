<?php declare(strict_types=1);

namespace App\Form\Post;

use App\Entity\PostInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PostFormData
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $title = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @var string
     */
    private $content = '';

    //-------------------------------------------------------------------------

    public static function fromPost(PostInterface $post): self
    {
        $formData = new self();
        $formData->setTitle($post->getTitle());
        $formData->setContent($post->getContent());

        return $formData;
    }

    //-------------------------------------------------------------------------

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
}

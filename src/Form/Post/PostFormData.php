<?php declare(strict_types=1);

namespace App\Form\Post;

use App\Entity\PostInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PostFormData implements PostFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="1", max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $slug = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $title = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $titleInRussian = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @var string
     */
    private $content = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @var string
     */
    private $contentInRussian = '';

    //-------------------------------------------------------------------------

    public static function fromPost(PostInterface $post): self
    {
        $formData = new self();
        $formData->setSlug($post->getSlug());
        $formData->setTitle($post->getTitle());
        $formData->setTitleInRussian($post->getTitleInRussian());
        $formData->setContent($post->getLastRevision()->getContent());
        $formData->setContentInRussian($post->getLastRevision()->getContentInRussian());

        return $formData;
    }

    //-------------------------------------------------------------------------

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
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
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContentInRussian(): string
    {
        return $this->contentInRussian;
    }

    public function setContentInRussian(string $contentInRussian): void
    {
        $this->contentInRussian = $contentInRussian;
    }
}

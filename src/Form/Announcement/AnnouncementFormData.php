<?php declare(strict_types=1);

namespace App\Form\Announcement;

use App\Entity\AnnouncementInterface;
use Symfony\Component\Validator\Constraints as Assert;

class AnnouncementFormData implements AnnouncementFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $title = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private string $content = '';

    //-------------------------------------------------------------------------

    public static function createFromAnnouncement(AnnouncementInterface $announcement): self
    {
        $formData = new self();

        $formData->setTitle($announcement->getTitle());
        $formData->setContent($announcement->getContent());

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

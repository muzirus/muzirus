<?php declare(strict_types=1);

namespace App\Form\SourceType;

use App\Entity\SourceTypeInterface;
use Symfony\Component\Validator\Constraints as Assert;

class SourceTypeFormData implements SourceTypeFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $title = '';

    //-------------------------------------------------------------------------

    public static function fromSourceType(SourceTypeInterface $sourceType): self
    {
        $formData = new self();

        $formData->setTitle($sourceType->getTitle());

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
}

<?php declare(strict_types=1);

namespace App\Form\SourceType;

use App\Entity\SourceType;
use Symfony\Component\Validator\Constraints as Assert;

class SourceTypeFormData implements SourceTypeFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $title = '';

    //-------------------------------------------------------------------------

    public static function createFromSourceType(SourceType $sourceType): self
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

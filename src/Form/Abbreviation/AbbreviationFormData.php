<?php

namespace App\Form\Abbreviation;

use App\Entity\AbbreviationInterface;
use Symfony\Component\Validator\Constraints as Assert;

class AbbreviationFormData
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
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $content = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $description = '';

    //-------------------------------------------------------------------------

    public static function fromAbbreviation(AbbreviationInterface $abbreviation): self
    {
        $formData = new self();
        $formData->setTitle($abbreviation->getTitle());
        $formData->setContent($abbreviation->getContent());
        $formData->setDescription($abbreviation->getDescription());

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}

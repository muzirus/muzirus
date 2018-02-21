<?php

namespace App\Form\Abbreviation;

use App\Entity\Abbreviation;

class AbbreviationFormData
{
    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $content = '';

    /**
     * @var string
     */
    private $description = '';

    //-------------------------------------------------------------------------

    public static function createFromAbbreviation(Abbreviation $abbreviation): self
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

<?php

namespace App\FormData;

use App\Entity\SourceType;

class SourceTypeFormData
{
    /**
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

<?php

namespace App\FormData;

use App\Entity\WordCategory;

class WordCategoryFormData
{
    /**
     * @var string
     */
    private $title = '';

    //-------------------------------------------------------------------------

    public static function createFromWordCategory(WordCategory $wordCategory): self
    {
        $formData = new self();

        $formData->setTitle($wordCategory->getTitle());

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

<?php

namespace App\Form\Category;

use App\Entity\WordCategory;

class CategoryFormData
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

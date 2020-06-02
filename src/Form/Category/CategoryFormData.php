<?php declare(strict_types=1);

namespace App\Form\Category;

use App\Entity\CategoryInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CategoryFormData implements CategoryFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $title = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $titleInRussian = '';

    //-------------------------------------------------------------------------

    public static function fromCategory(CategoryInterface $category): self
    {
        $formData = new self();

        $formData->setTitle($category->getTitle());
        $formData->setTitleInRussian($category->getTitleInRussian());

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

    public function getTitleInRussian(): string
    {
        return $this->titleInRussian;
    }

    public function setTitleInRussian(string $titleInRussian): void
    {
        $this->titleInRussian = $titleInRussian;
    }
}

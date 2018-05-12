<?php declare(strict_types=1);

namespace App\Form\Category;

use App\Entity\Category;
use Symfony\Component\Validator\Constraints as Assert;

class CategoryFormData implements CategoryFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $title = '';

    //-------------------------------------------------------------------------

    public static function createFromCategory(Category $category): self
    {
        $formData = new self();

        $formData->setTitle($category->getTitle());

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

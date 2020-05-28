<?php declare(strict_types=1);

namespace App\Form\Symbol;

use App\Entity\Symbol;
use Symfony\Component\Validator\Constraints as Assert;

class SymbolFormData implements SymbolFormDataInterface
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
    private string $content = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $description = '';

    //-------------------------------------------------------------------------

    public static function createFromSymbol(Symbol $symbol): self
    {
        $formData = new self();

        $formData->setTitle($symbol->getTitle());
        $formData->setContent($symbol->getContent());
        $formData->setDescription($symbol->getDescription());

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

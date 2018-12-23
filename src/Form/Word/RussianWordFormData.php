<?php declare(strict_types=1);

namespace App\Form\Word;

use App\Entity\RussianWordInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RussianWordFormData extends AbstractWordFormData implements RussianWordFormDataInterface
{
    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $contentWithAccent = '';

    //-------------------------------------------------------------------------

    public static function createFromWord(RussianWordInterface $word): self
    {
        $formData = new self();

        $formData->populate($word);

        if ($word->getContentWithAccent() !== '') {
            $formData->setContentWithAccent($word->getContentWithAccent());
        } else {
            $formData->setContentWithAccent($word->getContent());
        }

        return $formData;
    }

    //-------------------------------------------------------------------------

    public function getContentWithAccent(): string
    {
        return $this->contentWithAccent;
    }

    public function setContentWithAccent(string $contentWithAccent): void
    {
        $this->contentWithAccent = $contentWithAccent;
    }
}

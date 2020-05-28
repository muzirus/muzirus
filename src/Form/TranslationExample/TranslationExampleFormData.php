<?php declare(strict_types=1);

namespace App\Form\TranslationExample;

use App\Entity\TranslationExampleInterface;
use App\Entity\TranslationInterface;
use Symfony\Component\Validator\Constraints as Assert;

class TranslationExampleFormData implements TranslationExampleFormDataInterface
{
    private TranslationInterface $translation;

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $czechWordSentence = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     */
    private string $russianWordSentence = '';

    /**
     * @Assert\Type("boolean")
     */
    private bool $hidden = false;

    //-------------------------------------------------------------------------

    public function __construct(TranslationInterface $translation)
    {
        $this->translation = $translation;
    }

    //-------------------------------------------------------------------------

    public function getTranslation(): TranslationInterface
    {
        return $this->translation;
    }

    public function getCzechWordSentence(): string
    {
        return $this->czechWordSentence;
    }

    public function setCzechWordSentence(string $czechWordSentence): void
    {
        $this->czechWordSentence = $czechWordSentence;
    }

    public function getRussianWordSentence(): string
    {
        return $this->russianWordSentence;
    }

    public function setRussianWordSentence(string $russianWordSentence): void
    {
        $this->russianWordSentence = $russianWordSentence;
    }

    public function isHidden(): bool
    {
        return $this->hidden;
    }

    public function setHidden(bool $hidden): void
    {
        $this->hidden = $hidden;
    }

    //-------------------------------------------------------------------------

    public static function fromTranslationExample(TranslationExampleInterface $translationExample): self
    {
        $formData = new self($translationExample->getTranslation());

        $formData->setCzechWordSentence($translationExample->getCzechWordSentence());
        $formData->setRussianWordSentence($translationExample->getRussianWordSentence());
        $formData->setHidden($translationExample->isHidden());

        return $formData;
    }
}

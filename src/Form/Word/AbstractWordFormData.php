<?php declare(strict_types=1);

namespace App\Form\Word;

use App\Entity\AbstractWordInterface;
use App\Entity\SourceInterface;
use App\Entity\WordCategoryInterface;
use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractWordFormData implements AbstractWordFormDataInterface
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $content = '';

    /**
     * @Assert\Type("array")
     * @var WordCategoryInterface[]
     */
    private $categories = [];

    /**
     * @Assert\Type("array")
     * @var SourceInterface[]
     */
    private $sources = [];

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $languageNotePronunciation = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $languageNoteInflection = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $languageNoteExceptionToInflection = '';

    /**
     * @Assert\Type("integer")
     * @var int
     */
    private $languageNoteType = AbstractWordInterface::TYPE_UNKNOWN;

    /**
     * @Assert\Type("integer")
     * @var int
     */
    private $languageNoteGender = AbstractWordInterface::GENDER_UNKNOWN;

    /**
     * @Assert\Type("string")
     * @var string
     */
    private $languageNoteOther = '';

    /**
     * @Assert\Type("string")
     * @var string
     */
    private $explanation = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $explanationSourceInfo = '';

    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $explanationSourceDate = '';

    /**
     * @Assert\Type("string")
     * @var string
     */
    private $note = '';

    /**
     * @Assert\Type("integer")
     * @var int
     */
    private $statusLight = AbstractWordInterface::STATUS_LIGHT_NOT_PROCESSED;

    //-------------------------------------------------------------------------

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return WordCategoryInterface[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @param WordCategoryInterface[] $categories
     */
    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }

    /**
     * @return SourceInterface[]
     */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
     * @param SourceInterface[] $sources
     */
    public function setSources(array $sources): void
    {
        $this->sources = $sources;
    }

    public function getLanguageNotePronunciation(): string
    {
        return $this->languageNotePronunciation;
    }

    public function setLanguageNotePronunciation(string $languageNotePronunciation): void
    {
        $this->languageNotePronunciation = $languageNotePronunciation;
    }

    public function getLanguageNoteInflection(): string
    {
        return $this->languageNoteInflection;
    }

    public function setLanguageNoteInflection(string $languageNoteInflection): void
    {
        $this->languageNoteInflection = $languageNoteInflection;
    }

    public function getLanguageNoteExceptionToInflection(): string
    {
        return $this->languageNoteExceptionToInflection;
    }

    public function setLanguageNoteExceptionToInflection(string $languageNoteExceptionToInflection): void
    {
        $this->languageNoteExceptionToInflection = $languageNoteExceptionToInflection;
    }

    public function getLanguageNoteType(): int
    {
        return $this->languageNoteType;
    }

    public function setLanguageNoteType(int $languageNoteType): void
    {
        $this->languageNoteType = $languageNoteType;
    }

    public function getLanguageNoteGender(): int
    {
        return $this->languageNoteGender;
    }

    public function setLanguageNoteGender(int $languageNoteGender): void
    {
        $this->languageNoteGender = $languageNoteGender;
    }

    public function getLanguageNoteOther(): string
    {
        return $this->languageNoteOther;
    }

    public function setLanguageNoteOther(string $languageNoteOther): void
    {
        $this->languageNoteOther = $languageNoteOther;
    }

    public function getExplanation(): string
    {
        return $this->explanation;
    }

    public function setExplanation(string $explanation): void
    {
        $this->explanation = $explanation;
    }

    public function getExplanationSourceInfo(): string
    {
        return $this->explanationSourceInfo;
    }

    public function setExplanationSourceInfo(string $explanationSourceInfo): void
    {
        $this->explanationSourceInfo = $explanationSourceInfo;
    }

    public function getExplanationSourceDate(): string
    {
        return $this->explanationSourceDate;
    }

    public function setExplanationSourceDate(string $explanationSourceDate): void
    {
        $this->explanationSourceDate = $explanationSourceDate;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): void
    {
        $this->note = $note;
    }

    public function getStatusLight(): int
    {
        return $this->statusLight;
    }

    public function setStatusLight(int $statusLight): void
    {
        $this->statusLight = $statusLight;
    }

    public function populate(AbstractWordInterface $word): void
    {
        $this->setContent($word->getContent());
        $this->setCategories($word->getCategories());
        $this->setSources($word->getSources());
        $this->setLanguageNotePronunciation($word->getLanguageNotePronunciation());
        $this->setLanguageNoteInflection($word->getLanguageNoteInflection());
        $this->setLanguageNoteExceptionToInflection($word->getLanguageNoteExceptionToInflection());
        $this->setLanguageNoteType($word->getLanguageNoteType());
        $this->setLanguageNoteGender($word->getLanguageNoteGender());
        $this->setLanguageNoteOther($word->getLanguageNoteOther());
        $this->setExplanation($word->getExplanation());
        $this->setExplanationSourceInfo($word->getExplanationSourceInfo());
        $this->setExplanationSourceDate($word->getExplanationSourceDate());
        $this->setNote($word->getNote());
        $this->setStatusLight($word->getStatusLight());
    }
}

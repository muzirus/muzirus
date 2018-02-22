<?php

namespace App\Entity;

use App\EntityTrait\Timestamps;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TranslationExampleRepository")
 * @ORM\Table(name="translation_examples")
 * @ORM\HasLifecycleCallbacks()
 */
class TranslationExample implements TranslationExampleInterface
{
    use Timestamps;

    //-------------------------------------------------------------------------

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="bigint", name="id")
     * @var int
     */
    private $id;

    /**
     * Owning side.
     * @ORM\ManyToOne(targetEntity="Translation", inversedBy="translationExamples")
     * @ORM\JoinColumn(name="translation_id", referencedColumnName="id", onDelete="cascade")
     * @var Translation
     */
    private $translation;

    /**
     * @ORM\Column(type="string", name="first_word_sentence")
     * @var string
     */
    private $russianWordSentence = '';

    /**
     * @ORM\Column(type="string", name="second_word_sentence")
     * @var string
     */
    private $czechWordSentence = '';

    /**
     * Owning side.
     * @ORM\ManyToMany(targetEntity="User", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(
     *     name="translation_examples_approvals",
     *     joinColumns={@ORM\JoinColumn(name="translation_example_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     * @var ArrayCollection
     */
    private $approvals;

    /**
     * Owning side.
     * @ORM\ManyToMany(targetEntity="User", fetch="EXTRA_LAZY")
     * @ORM\JoinTable(
     *     name="translation_examples_refusals",
     *     joinColumns={@ORM\JoinColumn(name="translation_example_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     * )
     * @var ArrayCollection
     */
    private $refusals;

    //-------------------------------------------------------------------------

    public function __construct(TranslationInterface $translation, string $russianWordSentence, string $czechWordSentence)
    {
        $this->translation = $translation;
        $this->russianWordSentence = $russianWordSentence;
        $this->czechWordSentence = $czechWordSentence;
        $this->approvals = new ArrayCollection();
        $this->refusals = new ArrayCollection();
    }

    //-------------------------------------------------------------------------

    public function getId(): int
    {
        return $this->id;
    }

    public function getTranslation(): TranslationInterface
    {
        return $this->translation;
    }

    public function getRussianWordSentence(): string
    {
        return $this->russianWordSentence;
    }

    public function setRussianWordSentence(string $russianWordSentence): void
    {
        $this->russianWordSentence = $russianWordSentence;
    }

    public function getCzechWordSentence(): string
    {
        return $this->czechWordSentence;
    }

    public function setCzechWordSentence(string $czechWordSentence): void
    {
        $this->czechWordSentence = $czechWordSentence;
    }

    /**
     * @return UserInterface[]
     */
    public function getUsersThatApproved(): array
    {
        return $this->approvals->toArray();
    }

    public function countUsersThatApproved(): int
    {
        return $this->approvals->count();
    }

    public function hasApprovalFromUser(UserInterface $user): bool
    {
        return $this->approvals->contains($user);
    }

    public function addApprovalFromUser(UserInterface $user): void
    {
        $this->removeRefusalFromUser($user);
        if (!$this->approvals->contains($user)) {
            $this->approvals->add($user);
        }
    }

    public function removeApprovalFromUser(UserInterface $user): void
    {
        if ($this->hasApprovalFromUser($user)) {
            $this->approvals->removeElement($user);
        }
    }

    /**
     * @return UserInterface[]
     */
    public function getUsersThatRefused(): array
    {
        return $this->refusals->toArray();
    }

    public function countUsersThatRefused(): int
    {
        return $this->refusals->count();
    }

    public function hasRefusalFromUser(UserInterface $user): bool
    {
        return $this->refusals->contains($user);
    }

    public function addRefusalFromUser(UserInterface $user): void
    {
        $this->removeApprovalFromUser($user);
        if (!$this->refusals->contains($user)) {
            $this->refusals->add($user);
        }
    }

    public function removeRefusalFromUser(UserInterface $user): void
    {
        if ($this->hasRefusalFromUser($user)) {
            $this->refusals->removeElement($user);
        }
    }
}

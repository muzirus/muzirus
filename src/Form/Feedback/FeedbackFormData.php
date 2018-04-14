<?php declare(strict_types=1);

namespace App\Form\Feedback;

use Symfony\Component\Validator\Constraints as Assert;

class FeedbackFormData
{
    /**
     * @Assert\Length(max="255")
     * @Assert\Type("string")
     * @var string
     */
    private $email = '';

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @var string
     */
    private $content = '';

    //-------------------------------------------------------------------------

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}

<?php declare(strict_types=1);

namespace App\Form\Feedback;

interface FeedbackFormDataInterface
{
    public function getEmail(): string;

    public function setEmail(string $email): void;

    public function getContent(): string;

    public function setContent(string $content): void;
}

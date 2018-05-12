<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\MessageInterface;
use App\Form\Feedback\FeedbackFormDataInterface;

interface MessageFacadeInterface
{
    public function createFeedback(FeedbackFormDataInterface $formData): MessageInterface;
}

<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\Message;
use App\Entity\MessageInterface;
use App\Form\Feedback\FeedbackFormData;
use Doctrine\ORM\EntityManagerInterface;

class MessageFacade
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createFeedback(FeedbackFormData $formData): MessageInterface
    {
        $message = new Message($formData->getEmail(), $formData->getContent());

        $this->entityManager->persist($message);
        $this->entityManager->flush();

        return $message;
    }
}

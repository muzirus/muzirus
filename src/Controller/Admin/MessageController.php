<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Message;
use App\Repository\MessageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("admin/message", methods={"GET"}, name="admin.message")
     */
    public function index(MessageRepository $messageRepository): Response
    {
        return $this->render(
            'admin/message/index.html.twig',
            [
                'messages' => $messageRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("admin/message/{id}", methods={"GET"}, name="admin.message.view")
     */
    public function view(Message $message): Response
    {
        return $this->render(
            'admin/message/view.html.twig',
            [
                'message' => $message,
            ]
        );
    }
}

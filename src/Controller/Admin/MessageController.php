<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Message;
use App\Repository\MessageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends AbstractController
{
    /**
     * @Route("admin/message", name="admin.message")
     * @Method({"GET"})
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
     * @Route("admin/message/{id}", name="admin.message.view")
     * @Method({"GET"})
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

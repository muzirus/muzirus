<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopicController extends AbstractController
{
    /**
     * @Route("/topic/{id}", methods={"GET"}, name="app.topic")
     */
    public function index(Category $category): Response
    {
        return $this->render(
            'app/topic/index.html.twig',
            [
                'category' => $category,
            ]
        );
    }
}

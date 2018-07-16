<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopicsController extends AbstractController
{
    /**
     * @Route("/topics", methods={"GET"}, name="app.topics")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render(
            'app/topics/index.html.twig',
            [
                'categories' => $categoryRepository->findAllInAscendingOrder(),
            ]
        );
    }
}

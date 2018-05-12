<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\CategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

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

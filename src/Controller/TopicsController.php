<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\WordCategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class TopicsController extends AbstractController
{
    /**
     * @Route("/topics", methods={"GET"}, name="app.topics")
     */
    public function index(WordCategoryRepository $categoryRepository): Response
    {
        return $this->render(
            'app/topics/index.html.twig',
            [
                'categories' => $categoryRepository->findAllInAscendingOrder(),
            ]
        );
    }
}

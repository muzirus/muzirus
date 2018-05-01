<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotationsController extends AbstractController
{
    private const SLUG_NOTATIONS = 'notations';

    /**
     * @Route("/notations", name="app.notations", methods={"GET"})
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render(
            'app/notations/index.html.twig',
            [
                'post' => $postRepository->findOneBySlugWithAuthorAndRevisions(self::SLUG_NOTATIONS),
            ]
        );
    }
}

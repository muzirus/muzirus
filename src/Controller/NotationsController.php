<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/notations")
 */
class NotationsController extends AbstractController
{
    private const NOTATIONS_SLUG = 'notations';

    /**
     * @Route("", name="app.notations")
     * @Method("GET")
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render(
            'app/notations/index.html.twig',
            [
                'post' => $postRepository->findOneBySlug(self::NOTATIONS_SLUG),
            ]
        );
    }
}

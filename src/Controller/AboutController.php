<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\PostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/about")
 */
class AboutController extends AbstractController
{
    private const ABOUT_US_POST_SLUG = 'about';

    /**
     * @Route("", name="app.about")
     * @Method("GET")
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render(
            'app/about/index.html.twig',
            [
                'post' => $postRepository->findOneBySlug(self::ABOUT_US_POST_SLUG),
            ]
        );
    }
}

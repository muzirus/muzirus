<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class PageController extends AbstractController
{
    /**
     * @Route("/page/{slug}", requirements={"slug": "[a-z0-9][a-z0-9-]*"}, methods={"GET"}, name="app.page")
     * @Entity("post", expr="repository.findOneBySlugWithAuthorAndRevisions(slug)")
     */
    public function index(Post $post): Response
    {
        return $this->render(
            'app/page/index.html.twig',
            [
                'post' => $post,
            ]
        );
    }
}

<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class PageController extends AbstractController
{
    /**
     * @Route("/page/{slug}", name="app.page", requirements={"slug": "[a-z0-9][a-z0-9-]*"})
     * @ParamConverter("post", options={"id": "slug", "repository_method": "findOneBySlugWithAuthorAndRevisions"})
     * @Method("GET")
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

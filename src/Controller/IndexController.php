<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private const TITLE_PAGE_SLUG = 'http-www-muzirus-cz-cs';

    /**
     * @Route("", name="app.index")
     */
    public function index(PostRepository $postRepository): Response
    {
        return $this->render(
            'app/index/index.html.twig',
            [
                'page' => $postRepository->findOneBySlug(self::TITLE_PAGE_SLUG),
            ]
        );
    }

    /**
     * @Route("", name="app.index.without_locale")
     */
    public function indexWithoutLocale(): RedirectResponse
    {
        return $this->redirectToRoute('app.index');
    }
}

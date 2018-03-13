<?php

namespace App\Controller;

use App\Entity\RussianWord;
use App\Repository\RussianWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("russian-to-czech")
 */
class RussianToCzechController extends AbstractController
{
    /**
     * @Route("", name="app.russian_to_czech", defaults={"page": 1})
     * @Route(
     *     "/page/{page}",
     *     name="app.russian_to_czech.paginated",
     *     defaults={"page": 1},
     *     requirements={"page": "[1-9]\d*"}
     * )
     * @Method("GET")
     */
    public function index(int $page, RussianWordRepository $wordRepository): Response
    {
        return $this->render('app/russian-to-czech/index.html.twig', [
            'words' => $wordRepository->findWithTranslationsAsPaginator($page),
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app.russian_to_czech.detail", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function detail(RussianWord $word): Response
    {
        return $this->render('app/russian-to-czech/detail.html.twig', [
            'word' => $word,
        ]);
    }
}

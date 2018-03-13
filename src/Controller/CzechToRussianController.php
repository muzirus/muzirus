<?php

namespace App\Controller;

use App\Entity\CzechWord;
use App\Repository\CzechWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("czech-to-russian")
 */
class CzechToRussianController extends AbstractController
{
    /**
     * @Route("", name="app.czech_to_russian", defaults={"page": 1})
     * @Route(
     *     "/page/{page}",
     *     name="app.czech_to_russian.paginated",
     *     defaults={"page": 1},
     *     requirements={"page": "[1-9]\d*"}
     * )
     * @Method("GET")
     */
    public function index(int $page, CzechWordRepository $wordRepository): Response
    {
        return $this->render('app/czech-to-russian/index.html.twig', [
            'words' => $wordRepository->findWithTranslationsAsPaginator($page),
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app.czech_to_russian.detail", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function detail(CzechWord $word): Response
    {
        return $this->render('app/czech-to-russian/detail.html.twig', [
            'word' => $word,
        ]);
    }
}

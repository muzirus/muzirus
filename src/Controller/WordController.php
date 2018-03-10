<?php

namespace App\Controller;

use App\Entity\CzechWord;
use App\Entity\RussianWord;
use App\Repository\CzechWordRepository;
use App\Repository\RussianWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class WordController extends AbstractController
{
    /**
     * @Route("czech-to-russian", name="app.word.czech_to_russian", defaults={"page": 1})
     * @Route(
     *     "czech-to-russian/page/{page}",
     *     name="app.word.czech_to_russian.paginated",
     *     defaults={"page": 1},
     *     requirements={"page": "[1-9]\d*"}
     * )
     * @Method("GET")
     */
    public function czechToRussian(int $page, CzechWordRepository $wordRepository): Response
    {
        return $this->render('app/word/czech-to-russian.html.twig', [
            'words' => $wordRepository->findWithTranslationsAsPaginator($page),
        ]);
    }

    /**
     * @Route("czech-to-russian/detail/{id}", name="app.word.czech_to_russian.detail", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function czechToRussianDetail(CzechWord $word): Response
    {
        return $this->render('app/word/czech-to-russian-detail.html.twig', [
            'word' => $word,
        ]);
    }

    /**
     * @Route("russian-to-czech", name="app.word.russian_to_czech", defaults={"page": 1})
     * @Route(
     *     "russian-to-czech/page/{page}",
     *     name="app.word.russian_to_czech.paginated",
     *     defaults={"page": 1},
     *     requirements={"page": "[1-9]\d*"}
     * )
     * @Method("GET")
     */
    public function russianToCzech(int $page, RussianWordRepository $wordRepository): Response
    {
        return $this->render('app/word/russian-to-czech.html.twig', [
            'words' => $wordRepository->findWithTranslationsAsPaginator($page),
        ]);
    }

    /**
     * @Route("russian-to-czech/detail/{id}", name="app.word.russian_to_czech.detail", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function russianToCzechDetail(RussianWord $word): Response
    {
        return $this->render('app/word/russian-to-czech-detail.html.twig', [
            'word' => $word,
        ]);
    }
}

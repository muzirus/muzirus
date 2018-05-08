<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\CzechWord;
use App\Repository\CzechWordRepository;
use App\Service\Provider\CzechAlphabetProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("czech-to-russian")
 */
class CzechToRussianController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="app.czech_to_russian")
     */
    public function index(Request $request, CzechWordRepository $wordRepository): Response
    {
        $startsWith = $request->get('startsWith', CzechAlphabetProvider::getFirstCzechLetter());

        return $this->render('app/czech-to-russian/index.html.twig', [
            'words' => $wordRepository->findStartingWith($startsWith),
            'letters' => CzechAlphabetProvider::getCzechLetters(),
        ]);
    }

    /**
     * @Route("/detail/{id}", requirements={"id": "\d+"}, methods={"GET"}, name="app.czech_to_russian.detail")
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function detail(CzechWord $word, CzechWordRepository $wordRepository): Response
    {
        return $this->render('app/czech-to-russian/detail.html.twig', [
            'word' => $word,
            'wordNext' => $wordRepository->findOneNextWithTranslation($word),
            'wordPrev' => $wordRepository->findOnePrevWithTranslation($word),
        ]);
    }
}

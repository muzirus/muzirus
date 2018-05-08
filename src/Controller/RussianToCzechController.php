<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\RussianWord;
use App\Repository\RussianWordRepository;
use App\Service\Provider\RussianAlphabetProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("russian-to-czech")
 */
class RussianToCzechController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="app.russian_to_czech")
     */
    public function index(Request $request, RussianWordRepository $wordRepository): Response
    {
        $startsWith = $request->get('startsWith', RussianAlphabetProvider::getFirstRussianLetter());

        return $this->render('app/russian-to-czech/index.html.twig', [
            'words' => $wordRepository->findStartingWith($startsWith),
            'letters' => RussianAlphabetProvider::getRussianLetters(),
        ]);
    }

    /**
     * @Route("/detail/{id}", methods={"GET"}, requirements={"id": "\d+"}, name="app.russian_to_czech.detail")
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function detail(RussianWord $word, RussianWordRepository $wordRepository): Response
    {
        return $this->render('app/russian-to-czech/detail.html.twig', [
            'word' => $word,
            'wordNext' => $wordRepository->findOneNextWithTranslation($word),
            'wordPrev' => $wordRepository->findOnePrevWithTranslation($word),
        ]);
    }
}

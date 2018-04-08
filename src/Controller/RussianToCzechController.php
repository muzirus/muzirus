<?php

namespace App\Controller;

use App\Entity\RussianWord;
use App\Repository\RussianWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("russian-to-czech")
 */
class RussianToCzechController extends AbstractController
{
    private const LETTERS = [
        'а',
        'б',
        'в',
        'г',
        'д',
        'e',
        'ё',
        'ж',
        'з',
        'и',
        'й',
        'к',
        'л',
        'м',
        'н',
        'o',
        'п',
        'р',
        'с',
        'т',
        'y',
        'ф',
        'х',
        'ц',
        'ч',
        'ш',
        'щ',
        'ы',
        'э',
        'ю',
        'я',
    ];
    private const FIRST_LETTER = self::LETTERS[0];

    /**
     * @Route("", name="app.russian_to_czech")
     * @Method("GET")
     */
    public function index(Request $request, RussianWordRepository $wordRepository): Response
    {
        $startsWith = $request->get('startsWith', self::FIRST_LETTER);

        return $this->render('app/russian-to-czech/index.html.twig', [
            'words' => $wordRepository->findStartingWith($startsWith),
            'letters' => self::LETTERS,
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app.russian_to_czech.detail", requirements={"id": "\d+"})
     * @Method("GET")
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

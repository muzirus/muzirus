<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\CzechWord;
use App\Repository\CzechWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("czech-to-russian")
 */
class CzechToRussianController extends AbstractController
{
    private const LETTERS = [
        'a',
        'b',
        'c',
        'd',
        'e',
        'f',
        'g',
        'h',
        'ch',
        'i',
        'j',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'q',
        'r',
        's',
        't',
        'u',
        'v',
        'w',
        'x',
        'y',
        'z',
    ];
    private const FIRST_LETTER = self::LETTERS[0];

    /**
     * @Route("", name="app.czech_to_russian")
     * @Method("GET")
     */
    public function index(Request $request, CzechWordRepository $wordRepository): Response
    {
        $startsWith = $request->get('startsWith', self::FIRST_LETTER);

        return $this->render('app/czech-to-russian/index.html.twig', [
            'words' => $wordRepository->findStartingWith($startsWith),
            'letters' => self::LETTERS,
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

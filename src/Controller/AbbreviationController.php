<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\AbbreviationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AbbreviationController extends AbstractController
{
    /**
     * @Route("abbreviation", methods={"GET"}, name="app.abbreviation")
     */
    public function index(AbbreviationRepository $abbreviationRepository): Response
    {
        return $this->render('app/abbreviation/index.html.twig', [
            'abbreviations' => $abbreviationRepository->findAllInAscendingOrder(),
        ]);
    }
}

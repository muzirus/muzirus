<?php

namespace App\Controller;

use App\Repository\AbbreviationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AbbreviationController extends AbstractController
{
    /**
     * @Route("abbreviation", name="app.abbreviation")
     * @Method("GET")
     */
    public function index(AbbreviationRepository $abbreviationRepository): Response
    {
        return $this->render('app/abbreviation/index.html.twig', [
            'abbreviations' => $abbreviationRepository->getAll(),
        ]);
    }
}

<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/notations")
 */
class NotationsController extends AbstractController
{
    /**
     * @Route("", name="app.notations")
     * @Method("GET")
     */
    public function index(): Response
    {
        return $this->render('app/notations/index.html.twig');
    }
}

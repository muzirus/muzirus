<?php declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class NotationsController extends AbstractController
{
    /**
     * @Route("/notations", name="app.notations")
     * @Method("GET")
     */
    public function index(): Response
    {
        return $this->render('app/notations/index.html.twig');
    }
}

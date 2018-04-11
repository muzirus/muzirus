<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="app.index")
     */
    public function index(): Response
    {
        return $this->render('app/index/index.html.twig');
    }
}

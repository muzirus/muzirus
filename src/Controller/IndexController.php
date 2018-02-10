<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Route("/", name="title_page")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig');
    }
}

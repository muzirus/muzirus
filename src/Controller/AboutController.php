<?php declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/about")
 */
class AboutController extends AbstractController
{
    /**
     * @Route("", name="app.about")
     * @Method("GET")
     */
    public function index(): Response
    {
        return $this->render('app/about/index.html.twig');
    }
}

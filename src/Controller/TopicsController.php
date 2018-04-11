<?php declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/topics")
 */
class TopicsController extends AbstractController
{
    /**
     * @Route("", name="app.topics")
     * @Method("GET")
     */
    public function index(): Response
    {
        return $this->render('app/topics/index.html.twig');
    }
}

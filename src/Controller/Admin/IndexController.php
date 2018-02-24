<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin")
 */
class IndexController extends AbstractController
{
    /**
     * @Route("", name="admin")
     * @Method("GET")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('admin.dashboard');
    }
}

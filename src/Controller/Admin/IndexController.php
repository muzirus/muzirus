<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin")
 */
class IndexController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('admin.dashboard');
    }
}

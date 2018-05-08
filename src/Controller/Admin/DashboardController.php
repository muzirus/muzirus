<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin/dashboard")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.dashboard")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard/index.html.twig');
    }
}

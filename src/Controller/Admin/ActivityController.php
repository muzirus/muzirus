<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Repository\LogEntryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/activity")
 */
class ActivityController extends AbstractController
{
    /**
     * @Route("", name="admin.activity", defaults={"page": 1})
     * @Route(
     *     "/page/{page}",
     *     name="admin.activity.paginated",
     *     requirements={"page": "[1-9]\d*"}
     * )
     * @Method("GET")
     */
    public function index(int $page, LogEntryRepository $logEntryRepository): Response
    {
        return $this->render(
            'admin/activity/index.html.twig',
            [
                'logEntries' => $logEntryRepository->findAsPaginatorOptimizedForAdminActivityTimeline($page, 25),
            ]
        );
    }
}

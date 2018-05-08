<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Repository\LogEntryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/activity")
 */
class ActivityController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, defaults={"page": 1}, name="admin.activity")
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     methods={"GET"},
     *     name="admin.activity.paginated"
     * )
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

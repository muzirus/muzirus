<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.user")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render(
            'admin/user/index.html.twig',
            [
                'users' => $userRepository->findAll(),
            ]
        );
    }
}

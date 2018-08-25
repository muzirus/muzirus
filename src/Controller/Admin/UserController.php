<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\User;
use App\Facade\UserFacade;
use App\Form\User\UserForm;
use App\Form\User\UserFormData;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @var UserFacade
     */
    private $userFacade;

    public function __construct(UserFacade $userFacade)
    {
        $this->userFacade = $userFacade;
    }

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

    /**
     * @Route("/add", methods={"GET", "POST"}, name="admin.user.add")
     */
    public function add(Request $request): Response
    {
        $formData = new UserFormData();

        $form = $this->createForm(UserForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userFacade->createUser($formData);

            $this->addFlashSuccess(Flashes::USER_CREATED);

            return $this->redirect('admin.user');
        }

        return $this->render(
            'admin/user/add.html.twig',
            [
                'form' => $form,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.user.edit")
     */
    public function edit(Request $request, User $user): Response
    {
        $formData = UserFormData::createFromUser($user);

        $form = $this->createForm(UserForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userFacade->updateUser($user, $formData);

            $this->addFlashSuccess(Flashes::USER_UPDATED);

            return $this->redirect('admin.user');
        }

        return $this->render(
            'admin/user/edit.html.twig',
            [
                'form' => $form,
                'user' => $user,
            ]
        );
    }

    /**
     * @Route("/{id}/remove", requirements={"id": "\d+"}, methods={"POST"}, name="admin.user.remove")
     */
    public function remove(User $user): RedirectResponse
    {
        $this->userFacade->deleteUser($user);

        $this->addFlashSuccess(Flashes::USER_DELETED);

        return $this->redirect('admin.user');
    }
}

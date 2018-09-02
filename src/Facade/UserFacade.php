<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\UserInterface;
use App\Factory\UserFactory;
use App\Form\User\UserFormDataInterface;
use App\Service\UserUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserFacade implements UserFacadeInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var UserFactory */
    private $userFactory;

    /** @var UserUpdaterInterface */
    private $userUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserFactory $userFactory,
        UserUpdaterInterface $userUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->userFactory = $userFactory;
        $this->userUpdater = $userUpdater;
    }

    public function createUser(UserFormDataInterface $formData): UserInterface
    {
        $user = $this->userFactory->createFromFormData($formData);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    public function updateUser(UserInterface $user, UserFormDataInterface $formData): void
    {
        $this->userUpdater->updateUser($user, $formData);
        $this->entityManager->flush();
    }

    public function deleteUser(UserInterface $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}

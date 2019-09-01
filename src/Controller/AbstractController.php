<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as SymfonyAbstractController;

abstract class AbstractController extends SymfonyAbstractController
{
    private const FLASH_TYPE_INFO = 'info';
    private const FLASH_TYPE_SUCCESS = 'success';
    private const FLASH_TYPE_WARNING = 'warning';
    private const FLASH_TYPE_DANGER = 'danger';

    protected function addFlashInfo(string $message): void
    {
        $this->addFlash(self::FLASH_TYPE_INFO, $message);
    }

    protected function addFlashSuccess(string $message): void
    {
        $this->addFlash(self::FLASH_TYPE_SUCCESS, $message);
    }

    protected function addFlashWarning(string $message): void
    {
        $this->addFlash(self::FLASH_TYPE_WARNING, $message);
    }

    protected function addFlashDanger(string $message = 'Wild Application Error!'): void
    {
        $this->addFlash(self::FLASH_TYPE_DANGER, $message);
    }

    protected function getUser(): UserInterface
    {
        $user = parent::getUser();

        if ($user instanceof UserInterface) {
            return $user;
        }

        throw new \LogicException('You cannot get user if nobody is logged in.');
    }
}

<?php

namespace App\Controller;

abstract class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    protected const FLASH_TYPE_INFO = 'info';
    protected const FLASH_TYPE_SUCCESS = 'success';
    protected const FLASH_TYPE_WARNING = 'warning';
    protected const FLASH_TYPE_DANGER = 'danger';

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
}

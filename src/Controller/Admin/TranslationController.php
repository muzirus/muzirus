<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Repository\TranslationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/translation")
 */
class TranslationController extends AbstractController
{
    /**
     * @Route("", name="admin.translation")
     * @Method("GET")
     */
    public function index(TranslationRepository $translationRepository): Response
    {
        return $this->render(
            'admin/translation/index.html.twig',
            [
                'translations' => $translationRepository->getAll(),
            ]
        );
    }
}

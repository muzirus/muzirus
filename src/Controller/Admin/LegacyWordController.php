<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\LegacyWord;
use App\Repository\LegacyWordRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/legacy-word")
 */
class LegacyWordController extends AbstractController
{
    /**
     * @Route(methods={"GET"}, name="admin.legacy_word")
     */
    public function index(LegacyWordRepository $legacyWordRepository): Response
    {
        return $this->render(
            'admin/legacy-word/index.html.twig',
            [
                'words' => $legacyWordRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"}, methods={"GET"}, name="admin.legacy_word.view")
     */
    public function view(LegacyWord $word): Response
    {
        return $this->render(
            'admin/legacy-word/view.html.twig',
            [
                'word' => $word,
            ]
        );
    }
}

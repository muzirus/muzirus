<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\LegacyWord;
use App\Repository\LegacyWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/legacy-word")
 */
class LegacyWordController extends AbstractController
{
    /**
     * @Route(name="admin.legacy_word")
     * @Method("GET")
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
     * @Route("/{id}", name="admin.legacy_word.view", requirements={"id": "\d+"})
     * @Method("GET")
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

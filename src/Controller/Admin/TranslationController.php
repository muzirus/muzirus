<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Translation;
use App\Facade\TranslationFacade;
use App\Form\Translation\TranslationForm;
use App\Repository\TranslationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/translation")
 */
class TranslationController extends AbstractController
{
    /**
     * @var TranslationFacade
     */
    private $translationFacade;

    public function __construct(TranslationFacade $translationFacade)
    {
        $this->translationFacade = $translationFacade;
    }

    /**
     * @Route("", name="admin.translation")
     * @Method("GET")
     */
    public function index(TranslationRepository $translationRepository): Response
    {
        return $this->render(
            'admin/translation/index.html.twig',
            [
                'categories' => $translationRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.translation.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $form = $this->createForm(TranslationForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->translationFacade->createTranslation($form->getData());

            $this->addFlashSuccess('translation.created_successfully');

            return $this->redirectToRoute('admin.translation');
        }

        return $this->render(
            'admin/translation/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="admin.translation.view", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function view(Translation $translation): Response
    {
        return $this->render(
            'admin/translation/view.html.twig',
            [
                'translation' => $translation,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.translation.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Translation $translation): Response
    {
        // todo

        return $this->render(
            'admin/translation/edit.html.twig',
            [
                'translation' => $translation,
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.translation.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(Translation $translation): RedirectResponse
    {
        $this->translationFacade->deleteTranslation($translation);

        $this->addFlashSuccess('translation.deleted_successfully');

        return $this->redirectToRoute('admin.translation');
    }
}

<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\TranslationExample;
use App\Facade\TranslationExampleFacade;
use App\Form\TranslationExample\TranslationExampleForm;
use App\Repository\TranslationExampleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/translation-example")
 */
class TranslationExampleController extends AbstractController
{
    /**
     * @var TranslationExampleFacade
     */
    private $translationExampleFacade;

    public function __construct(TranslationExampleFacade $translationExampleFacade)
    {
        $this->translationExampleFacade = $translationExampleFacade;
    }

    /**
     * @Route("", name="admin.translation-example")
     * @Method("GET")
     */
    public function index(TranslationExampleRepository $translationExampleRepository): Response
    {
        return $this->render(
            'admin/translation-example/index.html.twig',
            [
                'examples' => $translationExampleRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.translation-example.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $form = $this->createForm(TranslationExampleForm::class);

//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->translationExampleFacade->createTranslationExample($form->getData());
//
//            $this->addFlashSuccess('translation-example.created_successfully');
//
//            return $this->redirectToRoute('admin.translation-example');
//        }

        return $this->render(
            'admin/translation-example/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="admin.translation-example.view", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function view(TranslationExample $translationExample): Response
    {
        return $this->render(
            'admin/translation-example/view.html.twig',
            [
                'translationExample' => $translationExample,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.translation-example.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(TranslationExample $translationExample): Response
    {
        // todo

        return $this->render(
            'admin/translation-example/edit.html.twig',
            [
                'translationExample' => $translationExample,
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.translation-example.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(TranslationExample $translationExample): RedirectResponse
    {
        $this->translationExampleFacade->deleteTranslationExample($translationExample);

        $this->addFlashSuccess('translation-example.deleted_successfully');

        return $this->redirectToRoute('admin.translation-example');
    }
}

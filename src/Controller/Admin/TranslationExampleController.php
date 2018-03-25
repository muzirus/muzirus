<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\TranslationExample;
use App\Event\TranslationExampleEvent;
use App\Events;
use App\Facade\TranslationExampleFacade;
use App\Form\TranslationExample\TranslationExampleForm;
use App\Form\TranslationExample\TranslationExampleFormData;
use App\Repository\TranslationExampleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/translation-example")
 */
class TranslationExampleController extends AbstractController
{
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
     * @Route("/{id}/edit", name="admin.translation-example.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(
        Request $request,
        TranslationExample $translationExample,
        TranslationExampleFacade $translationExampleFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = TranslationExampleFormData::fromTranslationExample($translationExample);

        $form = $this->createForm(TranslationExampleForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationExampleFacade->updateTranslationExample($translationExample, $formData);

            $dispatcher->dispatch(
                Events::TRANSLATION_EXAMPLE_UPDATED,
                new TranslationExampleEvent($this->getUser(), $translationExample)
            );

            $this->addFlashSuccess('admin.translation_example.updated');

            return $this->redirectToRoute(
                'admin.translation-example.edit',
                [
                    'id' => $translationExample->getId(),
                ]
            );
        }

        return $this->render(
            'admin/translation-example/edit.html.twig',
            [
                'form' => $form->createView(),
                'translationExample' => $translationExample,
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.translation-example.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(
        TranslationExample $translationExample,
        TranslationExampleFacade $translationExampleFacade
    ): RedirectResponse {
        $translationExampleFacade->deleteTranslationExample($translationExample);

        $this->addFlashSuccess('admin.translation_example.deleted');

        return $this->redirectToRoute('admin.translation-example');
    }
}

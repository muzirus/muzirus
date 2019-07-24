<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\TranslationExample;
use App\Event\TranslationExampleUpdatedEvent;
use App\Facade\TranslationExampleFacade;
use App\Form\TranslationExample\TranslationExampleForm;
use App\Form\TranslationExample\TranslationExampleFormData;
use App\Repository\TranslationExampleRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/translation-example")
 */
class TranslationExampleController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.translation-example")
     */
    public function index(TranslationExampleRepository $translationExampleRepository): Response
    {
        return $this->render(
            'admin/translation-example/index.html.twig',
            [
                'examples' => $translationExampleRepository->findAllWithTranslationAndWords(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.translation-example.edit")
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

            $dispatcher->dispatch(new TranslationExampleUpdatedEvent($this->getUser(), $translationExample));

            $this->addFlashSuccess(Flashes::TRANSLATION_EXAMPLE_UPDATED);

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
     * @Route("/{id}/remove", requirements={"id": "\d+"}, methods={"POST"}, name="admin.translation-example.remove")
     */
    public function remove(
        TranslationExample $translationExample,
        TranslationExampleFacade $translationExampleFacade
    ): RedirectResponse {
        $translationExampleFacade->deleteTranslationExample($translationExample);

        $this->addFlashSuccess(Flashes::TRANSLATION_EXAMPLE_DELETED);

        return $this->redirectToRoute('admin.translation-example');
    }
}

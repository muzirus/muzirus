<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Translation;
use App\Event\TranslationUpdatedEvent;
use App\Facade\TranslationFacade;
use App\Form\Translation\TranslationFormData;
use App\Form\Translation\UpdateTranslationForm;
use App\Repository\TranslationRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("admin/translation")
 */
class TranslationController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.translation")
     */
    public function index(TranslationRepository $translationRepository): Response
    {
        return $this->render(
            'admin/translation/index.html.twig',
            [
                'translations' => $translationRepository->findAllWithTranslationExamplesAndWords(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.translation.edit")
     */
    public function edit(
        Request $request,
        Translation $translation,
        TranslationFacade $translationFacade,
        EventDispatcherInterface $dispatcher,
        TranslatorInterface $translator
    ): Response {
        $formData = TranslationFormData::createFromTranslation($translation);

        $form = $this->createForm(UpdateTranslationForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationFacade->updateTranslation($translation, $formData);

            $dispatcher->dispatch(new TranslationUpdatedEvent($this->getUser(), $translation));

            $this->addFlashSuccess($translator->trans('admin.translation.updated', [], 'flashes'));

            return $this->redirectToRoute('admin.translation.edit', ['id' => $translation->getId()]);
        }

        return $this->render(
            'admin/translation/edit.html.twig',
            [
                'form' => $form->createView(),
                'translation' => $translation,
            ]
        );
    }

    /**
     * @Route("/{id}/remove", requirements={"id": "\d+"}, methods={"POST"}, name="admin.translation.remove")
     */
    public function remove(
        Translation $translation,
        TranslationFacade $translationFacade,
        TranslatorInterface $translator
    ): RedirectResponse {
        $translationFacade->deleteTranslation($translation);

        $this->addFlashSuccess($translator->trans('admin.translation.deleted', [], 'flashes'));

        return $this->redirectToRoute('admin.translation');
    }
}

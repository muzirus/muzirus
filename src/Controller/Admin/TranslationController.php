<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\Translation;
use App\Event\TranslationEvent;
use App\Events;
use App\Facade\TranslationFacade;
use App\Form\Translation\TranslationFormData;
use App\Form\Translation\UpdateTranslationForm;
use App\Repository\TranslationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/{id}/edit", name="admin.translation.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(
        Request $request,
        Translation $translation,
        TranslationFacade $translationFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = TranslationFormData::createFromTranslation($translation);

        $form = $this->createForm(UpdateTranslationForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationFacade->updateTranslation($translation, $formData);

            $dispatcher->dispatch(
                Events::TRANSLATION_UPDATED,
                new TranslationEvent($this->getUser(), $translation)
            );

            $this->addFlashSuccess('admin.translation.updated');

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
     * @Route("/{id}/remove", name="admin.translation.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(Translation $translation, TranslationFacade $translationFacade): RedirectResponse
    {
        $translationFacade->deleteTranslation($translation);

        $this->addFlashSuccess('admin.translation.deleted');

        return $this->redirectToRoute('admin.translation');
    }
}

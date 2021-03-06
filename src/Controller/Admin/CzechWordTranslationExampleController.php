<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\CzechWord;
use App\Entity\Translation;
use App\Entity\TranslationExample;
use App\Event\TranslationExampleCreatedEvent;
use App\Event\TranslationExampleUpdatedEvent;
use App\Facade\TranslationExampleFacade;
use App\Form\TranslationExample\TranslationExampleForm;
use App\Form\TranslationExample\TranslationExampleFormData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Webmozart\Assert\Assert;

/**
 * @Route("admin/czech-word")
 */
class CzechWordTranslationExampleController extends AbstractController
{
    /**
     * @Route(
     *     "/{id}/translations/{translationId}/examples",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     methods={"GET", "POST"},
     *     name="admin.czech-word.translations.examples"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     */
    public function translationExamples(
        Request $request,
        CzechWord $word,
        Translation $translation,
        TranslationExampleFacade $translationExampleFacade,
        EventDispatcherInterface $dispatcher,
        TranslatorInterface $translator
    ): Response {
        $formData = new TranslationExampleFormData($translation);
        $form = $this->createForm(TranslationExampleForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationExample = $translationExampleFacade->createTranslationExample($formData);

            $dispatcher->dispatch(new TranslationExampleCreatedEvent($this->getUser(), $translationExample));

            $this->addFlashSuccess($translator->trans('admin.translation_example.created', [], 'flashes'));

            return $this->redirectToRoute(
                'admin.czech-word.translations.examples',
                [
                    'id' => $word->getId(),
                    'translationId' => $translation->getId(),
                ]
            );
        }

        return $this->render(
            'admin/czech-word/translations/examples/index.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'translation' => $translation,
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/examples/{translationExampleId}/edit",
     *     requirements={"id": "\d+", "translationId": "\d+", "translationExampleId": "\d+"},
     *     methods={"GET", "POST"},
     *     name="admin.czech-word.translations.examples.edit"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @ParamConverter("translationExample", options={"id": "translationExampleId"})
     */
    public function translationExamplesEdit(
        Request $request,
        CzechWord $word,
        Translation $translation,
        TranslationExample $translationExample,
        TranslationExampleFacade $translationExampleFacade,
        EventDispatcherInterface $dispatcher,
        TranslatorInterface $translator
    ): Response {
        $formData = TranslationExampleFormData::fromTranslationExample($translationExample);

        $form = $this->createForm(TranslationExampleForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationExampleFacade->updateTranslationExample($translationExample, $formData);

            $dispatcher->dispatch(new TranslationExampleUpdatedEvent($this->getUser(), $translationExample));

            $this->addFlashSuccess($translator->trans('admin.translation_example.updated', [], 'flashes'));

            return $this->redirectToRoute(
                'admin.czech-word.translations.examples.edit',
                [
                    'id' => $word->getId(),
                    'translationId' => $translation->getId(),
                    'translationExampleId' => $translationExample->getId(),
                ]
            );
        }

        return $this->render(
            'admin/czech-word/translations/examples/edit.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'translation' => $translation,
                'translationExample' => $translationExample,
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/examples/{translationExampleId}/remove",
     *     requirements={"id": "\d+", "translationId": "\d+", "translationExampleId": "\d+"},
     *     methods={"POST"},
     *     name="admin.czech-word.translations.examples.remove"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @ParamConverter("translationExample", options={"id": "translationExampleId"})
     */
    public function translationExamplesRemove(
        CzechWord $word,
        Translation $translation,
        TranslationExample $translationExample,
        TranslationExampleFacade $translationExampleFacade,
        TranslatorInterface $translator
    ): RedirectResponse {
        Assert::same($word, $translation->getCzechWord());
        Assert::same($translation, $translationExample->getTranslation());

        $translationExampleFacade->deleteTranslationExample($translationExample);

        $this->addFlashSuccess($translator->trans('admin.translation_example.deleted', [], 'flashes'));

        return $this->redirectToRoute(
            'admin.czech-word.translations.examples',
            [
                'id' => $word->getId(),
                'translationId' => $translation->getId(),
            ]
        );
    }
}

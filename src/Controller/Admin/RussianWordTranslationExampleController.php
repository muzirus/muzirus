<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Events;
use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\RussianWord;
use App\Entity\Translation;
use App\Entity\TranslationExample;
use App\Event\TranslationExampleEvent;
use App\Facade\TranslationExampleFacade;
use App\Form\TranslationExample\TranslationExampleForm;
use App\Form\TranslationExample\TranslationExampleFormData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

/**
 * @Route("admin/russian-word")
 */
class RussianWordTranslationExampleController extends AbstractController
{
    /**
     * @Route(
     *     "/{id}/translations/{translationId}/examples",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     methods={"GET", "POST"},
     *     name="admin.russian-word.translations.examples"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     */
    public function translationExamples(
        Request $request,
        RussianWord $word,
        Translation $translation,
        TranslationExampleFacade $translationExampleFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = new TranslationExampleFormData($translation);
        $form = $this->createForm(TranslationExampleForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translationExample = $translationExampleFacade->createTranslationExample($formData);

            $dispatcher->dispatch(
                Events::TRANSLATION_EXAMPLE_CREATED,
                new TranslationExampleEvent($this->getUser(), $translationExample)
            );

            $this->addFlashSuccess(Flashes::TRANSLATION_EXAMPLE_CREATED);

            return $this->redirectToRoute(
                'admin.russian-word.translations.examples',
                [
                    'id' => $word->getId(),
                    'translationId' => $translation->getId(),
                ]
            );
        }

        return $this->render(
            'admin/russian-word/translations/examples/index.html.twig',
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
     *     name="admin.russian-word.translations.examples.edit"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @ParamConverter("translationExample", options={"id": "translationExampleId"})
     */
    public function translationExamplesEdit(
        Request $request,
        RussianWord $word,
        Translation $translation,
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

            $this->addFlashSuccess(Flashes::TRANSLATION_EXAMPLE_UPDATED);

            return $this->redirectToRoute(
                'admin.russian-word.translations.examples.edit',
                [
                    'id' => $word->getId(),
                    'translationId' => $translation->getId(),
                    'translationExampleId' => $translationExample->getId(),
                ]
            );
        }

        return $this->render(
            'admin/russian-word/translations/examples/edit.html.twig',
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
     *     name="admin.russian-word.translations.examples.remove"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @ParamConverter("translationExample", options={"id": "translationExampleId"})
     */
    public function translationExamplesRemove(
        RussianWord $word,
        Translation $translation,
        TranslationExample $translationExample,
        TranslationExampleFacade $translationExampleFacade
    ): RedirectResponse {
        Assert::same($word, $translation->getRussianWord());
        Assert::same($translation, $translationExample->getTranslation());

        $translationExampleFacade->deleteTranslationExample($translationExample);

        $this->addFlashSuccess(Flashes::TRANSLATION_EXAMPLE_DELETED);

        return $this->redirectToRoute(
            'admin.russian-word.translations.examples',
            [
                'id' => $word->getId(),
                'translationId' => $translation->getId(),
            ]
        );
    }
}

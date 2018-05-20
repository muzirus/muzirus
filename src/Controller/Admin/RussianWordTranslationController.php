<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Events;
use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\RussianWord;
use App\Entity\Translation;
use App\Event\TranslationEvent;
use App\Facade\TranslationFacade;
use App\Form\Translation\CreateRussianWordTranslationForm;
use App\Form\Translation\TranslationFormData;
use App\Form\Translation\UpdateTranslationForm;
use App\Repository\RussianWordRepository;
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
class RussianWordTranslationController extends AbstractController
{
    /**
     * @Route(
     *     "/{id}/translations",
     *     requirements={"id": "\d+"},
     *     methods={"GET", "POST"},
     *     name="admin.russian-word.translations"
     * )
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function translations(
        Request $request,
        RussianWord $word,
        TranslationFacade $translationFacade,
        RussianWordRepository $russianWordRepository,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = TranslationFormData::createFromRussianWord($word);

        $form = $this->createForm(CreateRussianWordTranslationForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translation = $translationFacade->createTranslation($formData);

            $dispatcher->dispatch(
                Events::TRANSLATION_CREATED,
                new TranslationEvent($this->getUser(), $translation)
            );

            $this->addFlashSuccess(Flashes::TRANSLATION_CREATED);

            return $this->redirectToRoute('admin.russian-word.translations', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/russian-word/translations/index.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'wordNext' => $russianWordRepository->findOneNext($word),
                'wordPrev' => $russianWordRepository->findOnePrev($word),
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/edit",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     methods={"GET", "POST"},
     *     name="admin.russian-word.translations.edit"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     */
    public function translationsEdit(
        Request $request,
        RussianWord $word,
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

            $this->addFlashSuccess(Flashes::TRANSLATION_UPDATED);

            return $this->redirectToRoute(
                'admin.russian-word.translations.edit',
                [
                    'id' => $translation->getRussianWord()->getId(),
                    'translationId' => $translation->getId(),
                ]
            );
        }

        return $this->render(
            'admin/russian-word/translations/edit.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'translation' => $translation,
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/remove",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     methods={"POST"},
     *     name="admin.russian-word.translations.remove"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     */
    public function translationsRemove(
        RussianWord $word,
        Translation $translation,
        TranslationFacade $translationFacade
    ): RedirectResponse {
        Assert::same($word, $translation->getRussianWord());

        $translationFacade->deleteTranslation($translation);

        $this->addFlashSuccess(Flashes::TRANSLATION_DELETED);

        return $this->redirectToRoute('admin.russian-word.translations', ['id' => $word->getId()]);
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/position/up",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     defaults={"position": "up"},
     *     methods={"GET"},
     *     name="admin.russian-word.translations.position.up"
     * )
     * @Route(
     *     "/{id}/translations/{translationId}/position/down",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     defaults={"position": "down"},
     *     methods={"GET"},
     *     name="admin.russian-word.translations.position.down"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     */
    public function translationsPosition(
        RussianWord $word,
        Translation $translation,
        TranslationFacade $translationFacade,
        string $position
    ): RedirectResponse {
        Assert::same($word, $translation->getRussianWord());

        $translationFacade->updateTranslationPositionInRussianWordDetail($translation, $position);

        $this->addFlashSuccess(Flashes::TRANSLATION_UPDATED);

        return $this->redirectToRoute(
            'admin.russian-word.translations',
            [
                'id' => $word->getId(),
            ]
        );
    }
}

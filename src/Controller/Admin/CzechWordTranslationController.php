<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Events;
use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\CzechWord;
use App\Entity\Translation;
use App\Event\TranslationEvent;
use App\Facade\TranslationFacade;
use App\Form\Translation\CreateCzechWordTranslationForm;
use App\Form\Translation\TranslationFormData;
use App\Form\Translation\UpdateTranslationForm;
use App\Repository\CzechWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

/**
 * @Route("admin/czech-word")
 */
class CzechWordTranslationController extends AbstractController
{
    /**
     * @Route(
     *     "/{id}/translations",
     *     requirements={"id": "\d+"},
     *     methods={"GET", "POST"},
     *     name="admin.czech-word.translations"
     * )
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function translations(
        Request $request,
        CzechWord $word,
        TranslationFacade $translationFacade,
        CzechWordRepository $czechWordRepository,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = TranslationFormData::createFromCzechWord($word);

        $form = $this->createForm(CreateCzechWordTranslationForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $translation = $translationFacade->createTranslation($formData);

            $dispatcher->dispatch(
                Events::TRANSLATION_CREATED,
                new TranslationEvent($this->getUser(), $translation)
            );

            $this->addFlashSuccess(Flashes::TRANSLATION_CREATED);

            return $this->redirectToRoute('admin.czech-word.translations', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/czech-word/translations/index.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'wordNext' => $czechWordRepository->findOneNext($word),
                'wordPrev' => $czechWordRepository->findOnePrev($word),
            ]
        );
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/edit",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     methods={"GET", "POST"},
     *     name="admin.czech-word.translations.edit"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     */
    public function translationsEdit(
        Request $request,
        CzechWord $word,
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
                'admin.czech-word.translations.edit',
                [
                    'id' => $translation->getCzechWord()->getId(),
                    'translationId' => $translation->getId(),
                ]
            );
        }

        return $this->render(
            'admin/czech-word/translations/edit.html.twig',
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
     *     name="admin.czech-word.translations.remove"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     */
    public function translationsRemove(
        CzechWord $word,
        Translation $translation,
        TranslationFacade $translationFacade
    ): RedirectResponse {
        Assert::same($word, $translation->getCzechWord());

        $translationFacade->deleteTranslation($translation);

        $this->addFlashSuccess(Flashes::TRANSLATION_DELETED);

        return $this->redirectToRoute('admin.czech-word.translations', ['id' => $word->getId()]);
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/position/up",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     defaults={"position": "up"},
     *     methods={"GET"},
     *     name="admin.czech-word.translations.position.up"
     * )
     * @Route(
     *     "/{id}/translations/{translationId}/position/down",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     defaults={"position": "down"},
     *     methods={"GET"},
     *     name="admin.czech-word.translations.position.down"
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     */
    public function translationsPosition(
        CzechWord $word,
        Translation $translation,
        TranslationFacade $translationFacade,
        string $position
    ): RedirectResponse {
        Assert::same($word, $translation->getCzechWord());

        $translationFacade->updateTranslationPositionInCzechWordDetail($translation, $position);

        $this->addFlashSuccess(Flashes::TRANSLATION_UPDATED);

        return $this->redirectToRoute(
            'admin.czech-word.translations',
            [
                'id' => $word->getId(),
            ]
        );
    }
}

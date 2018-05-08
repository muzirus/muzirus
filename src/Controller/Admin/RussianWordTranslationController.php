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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/russian-word")
 */
class RussianWordTranslationController extends AbstractController
{
    /**
     * @Route("/{id}/translations", name="admin.russian-word.translations", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
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
     *     name="admin.russian-word.translations.edit",
     *     requirements={"id": "\d+", "translationId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method({"GET", "POST"})
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
     *     name="admin.russian-word.translations.remove",
     *     requirements={"id": "\d+", "translationId": "\d+"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method("POST")
     */
    public function translationsRemove(
        RussianWord $word,
        Translation $translation,
        TranslationFacade $translationFacade
    ): RedirectResponse {
        // todo: check that translation belongs to that word

        $translationFacade->deleteTranslation($translation);

        $this->addFlashSuccess(Flashes::TRANSLATION_DELETED);

        return $this->redirectToRoute('admin.russian-word.translations', ['id' => $word->getId()]);
    }

    /**
     * @Route(
     *     "/{id}/translations/{translationId}/position/up",
     *     name="admin.russian-word.translations.position.up",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     defaults={"position": "up"}
     * )
     * @Route(
     *     "/{id}/translations/{translationId}/position/down",
     *     name="admin.russian-word.translations.position.down",
     *     requirements={"id": "\d+", "translationId": "\d+"},
     *     defaults={"position": "down"}
     * )
     * @ParamConverter("translation", options={"id": "translationId"})
     * @Method({"GET"})
     */
    public function translationsPosition(
        RussianWord $word,
        Translation $translation,
        TranslationFacade $translationFacade,
        string $position
    ): RedirectResponse {
        // todo: check that translation belongs to that word

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

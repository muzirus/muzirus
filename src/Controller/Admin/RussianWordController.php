<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\RussianWord;
use App\Event\RussianWordCreatedEvent;
use App\Event\RussianWordUpdatedEvent;
use App\Facade\RussianWordFacade;
use App\Form\Word\RussianWordForm;
use App\Form\Word\RussianWordFormData;
use App\Repository\RussianWordRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("admin/russian-word")
 */
class RussianWordController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.russian-word")
     */
    public function index(RussianWordRepository $russianWordRepository): Response
    {
        return $this->render(
            'admin/russian-word/index.html.twig',
            [
                'words' => $russianWordRepository->findAllOptimizedForAdminWordList(),
            ]
        );
    }

    /**
     * @Route("/add", methods={"GET", "POST"}, name="admin.russian-word.add")
     */
    public function add(
        Request $request,
        RussianWordFacade $russianWordFacade,
        EventDispatcherInterface $dispatcher,
        TranslatorInterface $translator
    ): Response {
        $formData = new RussianWordFormData();

        $form = $this->createForm(RussianWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $word = $russianWordFacade->createRussianWord($formData);

            $dispatcher->dispatch(new RussianWordCreatedEvent($this->getUser(), $word));

            $this->addFlashSuccess($translator->trans('admin.word.created', [], 'flashes'));

            return $this->redirectToRoute('admin.russian-word.edit', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/russian-word/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.russian-word.edit")
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function edit(
        Request $request,
        RussianWord $word,
        RussianWordFacade $russianWordFacade,
        RussianWordRepository $russianWordRepository,
        EventDispatcherInterface $dispatcher,
        TranslatorInterface $translator
    ): Response {
        $formData = RussianWordFormData::fromWord($word);

        $form = $this->createForm(RussianWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $russianWordFacade->updateRussianWord($word, $formData);

            $dispatcher->dispatch(new RussianWordUpdatedEvent($this->getUser(), $word));

            $this->addFlashSuccess($translator->trans('admin.word.updated', [], 'flashes'));

            return $this->redirectToRoute('admin.russian-word.edit', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/russian-word/edit.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'wordNext' => $russianWordRepository->findOneNext($word),
                'wordPrev' => $russianWordRepository->findOnePrev($word),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", requirements={"id": "\d+"}, methods={"POST"}, name="admin.russian-word.remove")
     */
    public function remove(
        RussianWord $word,
        RussianWordFacade $russianWordFacade,
        TranslatorInterface $translator
    ): RedirectResponse {
        $russianWordFacade->deleteRussianWord($word);

        $this->addFlashSuccess($translator->trans('admin.word.deleted', [], 'flashes'));

        return $this->redirectToRoute('admin.russian-word');
    }
}

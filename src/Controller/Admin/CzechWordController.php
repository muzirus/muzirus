<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\CzechWord;
use App\Event\CzechWordCreatedEvent;
use App\Event\CzechWordUpdatedEvent;
use App\Facade\CzechWordFacade;
use App\Form\Word\CzechWordForm;
use App\Form\Word\CzechWordFormData;
use App\Repository\CzechWordRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("admin/czech-word")
 */
class CzechWordController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.czech-word")
     */
    public function index(CzechWordRepository $czechWordRepository): Response
    {
        return $this->render(
            'admin/czech-word/index.html.twig',
            [
                'words' => $czechWordRepository->findAllOptimizedForAdminWordList(),
            ]
        );
    }

    /**
     * @Route("/add", methods={"GET", "POST"}, name="admin.czech-word.add")
     */
    public function add(
        Request $request,
        CzechWordFacade $czechWordFacade,
        EventDispatcherInterface $dispatcher,
        TranslatorInterface $translator
    ): Response {
        $formData = new CzechWordFormData();

        $form = $this->createForm(CzechWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $word = $czechWordFacade->createCzechWord($formData);

            $dispatcher->dispatch(new CzechWordCreatedEvent($this->getUser(), $word));

            $this->addFlashSuccess($translator->trans('admin.word.created', [], 'flashes'));

            return $this->redirectToRoute('admin.czech-word.edit', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/czech-word/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.czech-word.edit")
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function edit(
        Request $request,
        CzechWord $word,
        CzechWordFacade $czechWordFacade,
        CzechWordRepository $czechWordRepository,
        EventDispatcherInterface $dispatcher,
        TranslatorInterface $translator
    ): Response {
        $formData = CzechWordFormData::createFromWord($word);

        $form = $this->createForm(CzechWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $czechWordFacade->updateCzechWord($word, $formData);

            $dispatcher->dispatch(new CzechWordUpdatedEvent($this->getUser(), $word));

            $this->addFlashSuccess($translator->trans('admin.word.updated', [], 'flashes'));

            return $this->redirectToRoute('admin.czech-word.edit', ['id' => $word->getId()]);
        }

        return $this->render(
            'admin/czech-word/edit.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'wordNext' => $czechWordRepository->findOneNext($word),
                'wordPrev' => $czechWordRepository->findOnePrev($word),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", requirements={"id": "\d+"}, methods={"POST"}, name="admin.czech-word.remove")
     */
    public function remove(
        CzechWord $word,
        CzechWordFacade $czechWordFacade,
        TranslatorInterface $translator
    ): RedirectResponse {
        $czechWordFacade->deleteCzechWord($word);

        $this->addFlashSuccess($translator->trans('admin.word.deleted', [], 'flashes'));

        return $this->redirectToRoute('admin.czech-word');
    }
}

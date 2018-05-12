<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Events;
use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\RussianWord;
use App\Event\RussianWordEvent;
use App\Facade\RussianWordFacade;
use App\Form\Word\RussianWordForm;
use App\Form\Word\RussianWordFormData;
use App\Repository\RussianWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = new RussianWordFormData();

        $form = $this->createForm(RussianWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $word = $russianWordFacade->createRussianWord($formData);

            $dispatcher->dispatch(
                Events::RUSSIAN_WORD_CREATED,
                new RussianWordEvent($this->getUser(), $word)
            );

            $this->addFlashSuccess(Flashes::WORD_CREATED);

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
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = RussianWordFormData::createFromWord($word);

        $form = $this->createForm(RussianWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $russianWordFacade->updateRussianWord($word, $formData);

            $dispatcher->dispatch(
                Events::RUSSIAN_WORD_UPDATED,
                new RussianWordEvent($this->getUser(), $word)
            );

            $this->addFlashSuccess(Flashes::WORD_UPDATED);

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
    public function remove(RussianWord $word, RussianWordFacade $russianWordFacade): RedirectResponse
    {
        $russianWordFacade->deleteRussianWord($word);

        $this->addFlashSuccess('admin.word.deleted');

        return $this->redirectToRoute(Flashes::WORD_DELETED);
    }
}

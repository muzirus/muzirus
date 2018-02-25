<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\CzechWord;
use App\Facade\CzechWordFacade;
use App\Form\Word\CzechWordForm;
use App\Form\Word\CzechWordFormData;
use App\Repository\CzechWordRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/czech-word")
 */
class CzechWordController extends AbstractController
{
    /**
     * @var CzechWordFacade
     */
    private $czechWordFacade;

    /**
     * @var CzechWordRepository
     */
    private $czechWordRepository;

    public function __construct(CzechWordFacade $czechWordFacade, CzechWordRepository $czechWordRepository)
    {
        $this->czechWordFacade = $czechWordFacade;
        $this->czechWordRepository = $czechWordRepository;
    }

    /**
     * @Route("", name="admin.czech-word")
     * @Method("GET")
     */
    public function index(): Response
    {
        return $this->render(
            'admin/czech-word/index.html.twig',
            [
                'czechWords' => $this->czechWordRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.czech-word.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $formData = new CzechWordFormData();

        $form = $this->createForm(CzechWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->czechWordFacade->createWord($formData);

            $this->addFlashSuccess('czech-word.created_successfully');

            return $this->redirectToRoute('admin.czech-word');
        }

        return $this->render(
            'admin/czech-word/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="admin.czech-word.view", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function view(CzechWord $czechWord): Response
    {
        return $this->render(
            'admin/czech-word/view.html.twig',
            [
                'czechWord' => $czechWord,
            ]
        );
    }

    /**
     * @Route("/{id}/translations", name="admin.czech-word.view-translations", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function viewTranslations(CzechWord $czechWord): Response
    {
        return $this->render(
            'admin/czech-word/view-translations.html.twig',
            [
                'czechWord' => $czechWord,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.czech-word.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, CzechWord $word): Response
    {
        $formData = CzechWordFormData::createFromWord($word);

        $form = $this->createForm(CzechWordForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->czechWordFacade->updateWord($word, $formData);

            $this->addFlashSuccess('czech-word.updated_successfully');

            return $this->redirectToRoute('admin.czech-word');
        }

        return $this->render(
            'admin/czech-word/edit.html.twig',
            [
                'form' => $form->createView(),
                'word' => $word,
                'wordNext' => $this->czechWordRepository->findOneNext($word),
                'wordPrev' => $this->czechWordRepository->findOnePrev($word),
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.czech-word.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(CzechWord $czechWord): RedirectResponse
    {
        $this->czechWordFacade->deleteWord($czechWord);

        $this->addFlashSuccess('czech-word.deleted_successfully');

        return $this->redirectToRoute('admin.czech-word');
    }
}

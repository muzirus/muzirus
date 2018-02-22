<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\WordCategory;
use App\Facade\CategoryFacade;
use App\Form\Category\CategoryForm;
use App\Repository\WordCategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends AbstractController
{
    /**
     * @var CategoryFacade
     */
    private $categoryFacade;

    public function __construct(CategoryFacade $categoryFacade)
    {
        $this->categoryFacade = $categoryFacade;
    }

    /**
     * @Route("", name="admin.category")
     * @Method("GET")
     */
    public function index(WordCategoryRepository $categoryRepository): Response
    {
        return $this->render(
            'admin/category/index.html.twig',
            [
                'categories' => $categoryRepository->getAll(),
            ]
        );
    }

    /**
     * @Route("/add", name="admin.category.add")
     * @Method({"GET", "POST"})
     */
    public function add(Request $request): Response
    {
        $form = $this->createForm(CategoryForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryFacade->createCategory($form->getData());

            $this->addFlashSuccess('category.created_successfully');

            return $this->redirectToRoute('admin.category');
        }

        return $this->render(
            'admin/category/add.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="admin.category.view", requirements={"id": "\d+"})
     * @Method("GET")
     */
    public function view(WordCategory $category): Response
    {
        return $this->render(
            'admin/category/view.html.twig',
            [
                'category' => $category,
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="admin.category.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(WordCategory $category): Response
    {
        // todo

        return $this->render(
            'admin/category/edit.html.twig',
            [
                'category' => $category,
            ]
        );
    }

    /**
     * @Route("/{id}/remove", name="admin.category.remove", requirements={"id": "\d+"})
     * @Method("POST")
     */
    public function remove(WordCategory $category): RedirectResponse
    {
        $this->categoryFacade->deleteCategory($category);

        $this->addFlashSuccess('category.deleted_successfully');

        return $this->redirectToRoute('admin.category');
    }
}

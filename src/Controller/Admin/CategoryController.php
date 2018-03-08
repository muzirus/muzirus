<?php

namespace App\Controller\Admin;

use App\Controller\AbstractController;
use App\Entity\WordCategory;
use App\Facade\CategoryFacade;
use App\Form\Category\CategoryForm;
use App\Form\Category\CategoryFormData;
use App\Repository\WordCategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/category")
 */
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
        $formData = new CategoryFormData();

        $form = $this->createForm(CategoryForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryFacade->createCategory($formData);

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
     * @Route("/{id}/edit", name="admin.category.edit", requirements={"id": "\d+"})
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, WordCategory $category): Response
    {
        $formData = CategoryFormData::createFromWordCategory($category);

        $form = $this->createForm(CategoryForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->categoryFacade->updateCategory($category, $formData);

            $this->addFlashSuccess('category.update_successfully');

            return $this->redirectToRoute('admin.category');
        }

        return $this->render(
            'admin/category/edit.html.twig',
            [
                'category' => $category,
                'form' => $form->createView(),
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

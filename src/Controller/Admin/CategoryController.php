<?php declare(strict_types=1);

namespace App\Controller\Admin;

use App\Constant\Events;
use App\Constant\Flashes;
use App\Controller\AbstractController;
use App\Entity\WordCategory;
use App\Event\CategoryEvent;
use App\Facade\CategoryFacade;
use App\Form\Category\CategoryForm;
use App\Form\Category\CategoryFormData;
use App\Repository\WordCategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("admin/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("", methods={"GET"}, name="admin.category")
     */
    public function index(WordCategoryRepository $categoryRepository): Response
    {
        return $this->render(
            'admin/category/index.html.twig',
            [
                'categories' => $categoryRepository->findAllInAscendingOrder(),
            ]
        );
    }

    /**
     * @Route("/add", methods={"GET", "POST"}, name="admin.category.add")
     */
    public function add(
        Request $request,
        CategoryFacade $categoryFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = new CategoryFormData();

        $form = $this->createForm(CategoryForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $categoryFacade->createCategory($formData);

            $dispatcher->dispatch(
                Events::CATEGORY_CREATED,
                new CategoryEvent($this->getUser(), $category)
            );

            $this->addFlashSuccess(Flashes::CATEGORY_CREATED);

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
     * @Route("/{id}/edit", requirements={"id": "\d+"}, methods={"GET", "POST"}, name="admin.category.edit")
     */
    public function edit(
        Request $request,
        WordCategory $category,
        CategoryFacade $categoryFacade,
        EventDispatcherInterface $dispatcher
    ): Response {
        $formData = CategoryFormData::createFromWordCategory($category);

        $form = $this->createForm(CategoryForm::class, $formData);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryFacade->updateCategory($category, $formData);

            $dispatcher->dispatch(
                Events::CATEGORY_UPDATED,
                new CategoryEvent($this->getUser(), $category)
            );

            $this->addFlashSuccess(Flashes::CATEGORY_UPDATED);

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
     * @Route("/{id}/remove", requirements={"id": "\d+"}, methods={"POST"}, name="admin.category.remove")
     */
    public function remove(WordCategory $category, CategoryFacade $categoryFacade): RedirectResponse
    {
        $categoryFacade->deleteCategory($category);

        $this->addFlashSuccess(Flashes::CATEGORY_DELETED);

        return $this->redirectToRoute('admin.category');
    }
}

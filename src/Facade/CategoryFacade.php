<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\CategoryInterface;
use App\Factory\CategoryFactoryInterface;
use App\Form\Category\CategoryFormDataInterface;
use App\Service\CategoryUpdaterInterface;
use Doctrine\ORM\EntityManagerInterface;

class CategoryFacade implements CategoryFacadeInterface
{
    private EntityManagerInterface $entityManager;

    private CategoryFactoryInterface $categoryFactory;

    private CategoryUpdaterInterface $categoryUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        CategoryFactoryInterface $categoryFactory,
        CategoryUpdaterInterface $categoryUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->categoryFactory = $categoryFactory;
        $this->categoryUpdater = $categoryUpdater;
    }

    public function createCategory(CategoryFormDataInterface $formData): CategoryInterface
    {
        $category = $this->categoryFactory->createFromFormData($formData);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        return $category;
    }

    public function updateCategory(CategoryInterface $category, CategoryFormDataInterface $formData): void
    {
        $this->categoryUpdater->updateCategory($category, $formData);

        $this->entityManager->flush();
    }

    public function deleteCategory(CategoryInterface $category): void
    {
        $this->entityManager->remove($category);
        $this->entityManager->flush();
    }
}

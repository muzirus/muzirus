<?php declare(strict_types=1);

namespace App\Facade;

use App\Entity\WordCategoryInterface as CategoryInterface;
use App\Factory\CategoryFactory;
use App\Form\Category\CategoryFormDataInterface;
use App\Service\CategoryUpdater;
use Doctrine\ORM\EntityManagerInterface;

class CategoryFacade implements CategoryFacadeInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var CategoryFactory */
    private $categoryFactory;

    /** @var CategoryUpdater */
    private $categoryUpdater;

    public function __construct(
        EntityManagerInterface $entityManager,
        CategoryFactory $categoryFactory,
        CategoryUpdater $categoryUpdater
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

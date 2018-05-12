<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use App\Entity\CategoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return CategoryInterface[]
     */
    public function findAllInAscendingOrder(): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

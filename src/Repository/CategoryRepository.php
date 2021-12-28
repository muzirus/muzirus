<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use App\Entity\CategoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
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

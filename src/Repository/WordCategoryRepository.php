<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\WordCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class WordCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WordCategory::class);
    }

    /**
     * @return WordCategory[]
     */
    public function getAll(): array
    {
        return $this->createQueryBuilder('wc')
            ->orderBy('wc.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

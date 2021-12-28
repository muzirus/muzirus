<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\LegacyWord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LegacyWordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LegacyWord::class);
    }

    /**
     * @return LegacyWord[]
     */
    public function getAll(): array
    {
        return $this->createQueryBuilder('lw')
            ->orderBy('lw.original', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

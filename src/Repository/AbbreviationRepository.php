<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Abbreviation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AbbreviationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Abbreviation::class);
    }

    /**
     * @return Abbreviation[]
     */
    public function findAllInAscendingOrder(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.content', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Symbol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class SymbolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Symbol::class);
    }

    /**
     * @return Symbol[]
     */
    public function findAllInAscendingOrder(): array
    {
        return $this
            ->createQueryBuilder('s')
            ->orderBy('s.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

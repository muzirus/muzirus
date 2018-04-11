<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Abbreviation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class AbbreviationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
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

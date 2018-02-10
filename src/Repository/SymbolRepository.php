<?php

namespace App\Repository;

use App\Entity\Symbol;
use Doctrine\ORM\EntityRepository;

class SymbolRepository extends EntityRepository
{
    /**
     * @return Symbol[]
     */
    public function getAll(): array
    {
        return $this
            ->createQueryBuilder('s')
            ->orderBy('s.title', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @return Symbol
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneById(int $id): Symbol
    {
        return $this
            ->createQueryBuilder('s')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }
}

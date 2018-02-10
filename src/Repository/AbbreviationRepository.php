<?php

namespace App\Repository;

use App\Entity\Abbreviation;
use Doctrine\ORM\EntityRepository;

class AbbreviationRepository extends EntityRepository
{
    /**
     * @return Abbreviation[]
     */
    public function getAll(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.content', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @return Abbreviation
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneById(int $id): Abbreviation
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }
}

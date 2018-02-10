<?php

namespace App\Repository;

use App\Entity\Source;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;

class SourceRepository extends EntityRepository
{
    /**
     * @return Source[]
     */
    public function getAll(): array
    {
        $qb = $this->createQueryBuilder('s');
        $qb->select(['s', 'st']);
        $qb->join('s.type', 'st');
        $qb->orderBy('s.title', 'ASC');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param array $ids
     * @return Source[]
     */
    public function getAllWithIds(array $ids): array
    {
        // todo: use query builder
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->in('id', $ids));
        $criteria->orderBy(['title' => 'ASC']);

        return $this->matching($criteria)->toArray();
    }

    /**
     * @param int $id
     * @return Source
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneById(int $id): Source
    {
        $qb = $this->createQueryBuilder('s');
        $qb->where('s.id = :id')->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }
}

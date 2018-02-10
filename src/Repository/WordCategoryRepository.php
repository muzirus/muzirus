<?php

namespace App\Repository;

use App\Entity\WordCategory;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;

class WordCategoryRepository extends EntityRepository
{
    /**
     * @return WordCategory[]
     */
    public function getAll(): array
    {
        $qb = $this->createQueryBuilder('wc');
        $qb->orderBy('wc.title', 'ASC');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param array $ids
     * @return WordCategory[]
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
     * @return WordCategory
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneById(int $id): WordCategory
    {
        $qb = $this->createQueryBuilder('wc');
        $qb->where('wc.id = :id')->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }
}

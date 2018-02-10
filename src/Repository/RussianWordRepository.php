<?php

namespace App\Repository;

use App\Entity\RussianWordInterface;
use Doctrine\ORM\EntityRepository;

class RussianWordRepository extends EntityRepository
{
    /**
     * @return RussianWordInterface[]
     */
    public function getAll(): array
    {
        return $this
            ->createQueryBuilder('w')
            ->select(['w', 't'])
            ->leftJoin('w.translations', 't')
            ->orderBy('w.content', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @return RussianWordInterface
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOne(int $id): RussianWordInterface
    {
        return $this
            ->createQueryBuilder('w')
            ->select(['w', 't'])
            ->leftJoin('w.translations', 't')
            ->where('w.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @param RussianWordInterface $word
     * @return RussianWordInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOnePrev(RussianWordInterface $word): ?RussianWordInterface
    {
        return $this
            ->createQueryBuilder('w')
            ->select('w')
            ->andWhere('w.content < :content')
            ->setParameter('content', $word->getContent())
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->orderBy('w.content', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param RussianWordInterface $word
     * @return RussianWordInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneNext(RussianWordInterface $word): ?RussianWordInterface
    {
        return $this
            ->createQueryBuilder('w')
            ->select('w')
            ->andWhere('w.content > :content')
            ->setParameter('content', $word->getContent())
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->orderBy('w.content', 'ASC')
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCount(): int
    {
        return $this
            ->createQueryBuilder('w')
            ->select('COUNT(w)')
            ->getQuery()
            ->getSingleScalarResult();
    }
}

<?php

namespace App\Repository;

use App\Entity\CzechWordInterface;
use Doctrine\ORM\EntityRepository;

class CzechWordRepository extends EntityRepository
{
    /**
     * @return CzechWordInterface[]
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
     * @return CzechWordInterface
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOne(int $id): CzechWordInterface
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
     * @param CzechWordInterface $word
     * @return CzechWordInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOnePrev(CzechWordInterface $word): ?CzechWordInterface
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
     * @param CzechWordInterface $word
     * @return CzechWordInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneNext(CzechWordInterface $word): ?CzechWordInterface
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

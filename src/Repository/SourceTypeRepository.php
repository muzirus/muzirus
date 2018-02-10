<?php

namespace App\Repository;

use App\Entity\SourceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class SourceTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SourceType::class);
    }

    /**
     * @return SourceType[]
     */
    public function getAll(): array
    {
        $qb = $this->createQueryBuilder('st');
        $qb->orderBy('st.title', 'ASC');

        return $qb->getQuery()->getResult();
    }

    /**
     * @param int $id
     * @return SourceType
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneById(int $id): SourceType
    {
        $qb = $this->createQueryBuilder('st');
        $qb->where('st.id = :id')->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }
}

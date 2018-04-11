<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Source;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bridge\Doctrine\RegistryInterface;

class SourceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Source::class);
    }

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
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @return Source
     */
    public function getOneById(int $id): Source
    {
        $qb = $this->createQueryBuilder('s');
        $qb->where('s.id = :id')->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }
}

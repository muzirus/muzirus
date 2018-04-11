<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\WordCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bridge\Doctrine\RegistryInterface;

class WordCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WordCategory::class);
    }

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
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @return WordCategory
     */
    public function getOneById(int $id): WordCategory
    {
        $qb = $this->createQueryBuilder('wc');
        $qb->where('wc.id = :id')->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }
}

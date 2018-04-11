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
    public function getAll(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.content', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @return Abbreviation
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

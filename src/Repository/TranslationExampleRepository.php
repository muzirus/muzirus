<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\TranslationExample;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TranslationExampleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TranslationExample::class);
    }

    /**
     * @return TranslationExample[]
     */
    public function getAll(): array
    {
        return $this
            ->createQueryBuilder('te')
            ->select(['te', 't', 'cw', 'rw'])
            ->join('te.translation', 't')
            ->join('t.russianWord', 'rw')
            ->join('t.czechWord', 'cw')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @return TranslationExample
     */
    public function getOne(int $id): TranslationExample
    {
        return $this->createQueryBuilder('te')
            ->select('te')
            ->where('te.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }
}

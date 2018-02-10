<?php

namespace App\Repository;

use App\Entity\CzechWordInterface;
use App\Entity\RussianWordInterface;
use App\Entity\Translation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TranslationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Translation::class);
    }

    /**
     * @return Translation[]
     */
    public function getAll(): array
    {
        return $this
            ->createQueryBuilder('t')
            ->select(['t', 'te', 'rw', 'cw', 'a', 'r'])
            ->leftJoin('t.translationExamples', 'te')
            ->leftJoin('t.russianWord', 'rw')
            ->leftJoin('t.czechWord', 'cw')
            ->leftJoin('t.approvals', 'a')
            ->leftJoin('t.refusals', 'r')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $id
     * @return Translation
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneById(int $id): Translation
    {
        $qb = $this->createQueryBuilder('t');

        $qb->select(['t']);
        $qb->where('t.id = :id');
        $qb->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * @param RussianWordInterface $firstWord
     * @param CzechWordInterface $secondWord
     * @return Translation
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneByWords(RussianWordInterface $firstWord, CzechWordInterface $secondWord): Translation
    {
        $qb = $this->createQueryBuilder('t');

        $qb->where('t.firstWord = :firstWord');
        $qb->andWhere('t.secondWord = :secondWord');

        $qb->setParameter('firstWord', $firstWord);
        $qb->setParameter('secondWord', $secondWord);

        return $qb->getQuery()->getSingleResult();
    }
}

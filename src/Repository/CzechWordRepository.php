<?php

namespace App\Repository;

use App\Entity\CzechWord;
use App\Entity\CzechWordInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CzechWordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CzechWord::class);
    }

    /**
     * @return CzechWordInterface[]
     */
    public function getAll(): array
    {
        return $this
            ->createQueryBuilder('w')
            ->select(['w', 't'])
            ->join('w.translations', 't')
            ->orderBy('w.content', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Pagerfanta|CzechWordInterface[]
     */
    public function findWithTranslationsAsPaginator(int $page, int $maxPerPage = 10): Pagerfanta
    {
        $query = $this->createQueryBuilder('cw')
            ->select(['cw', 't', 'rw'])
            ->join('cw.translations', 't')
            ->join('t.russianWord', 'rw')
            ->orderBy('cw.content', 'ASC')
            ->getQuery();


        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage($maxPerPage);
        $paginator->setCurrentPage($page);

        return $paginator;
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
}

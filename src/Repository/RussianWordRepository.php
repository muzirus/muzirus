<?php

namespace App\Repository;

use App\Entity\RussianWord;
use App\Entity\RussianWordInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\RegistryInterface;

class RussianWordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RussianWord::class);
    }

    /**
     * @return RussianWordInterface[]
     */
    public function findAllOptimizedForAdminWordList(): array
    {
        return $this
            ->createQueryBuilder('w')
            ->select([
                'partial w.{id, content, contentWithAccent, languageNoteExceptionToInflection, languageNoteGender, statusLight, imported, createdAt, updatedAt}',
                'partial t.{id}',
            ])
            ->leftJoin('w.translations', 't')
            ->orderBy('w.content', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Pagerfanta|RussianWordInterface[]
     */
    public function findWithTranslationsAsPaginator(int $page, int $maxPerPage = 10): Pagerfanta
    {
        $query = $this
            ->createQueryBuilder('rw')
            ->select(['rw', 't', 'cw'])
            ->join('rw.translations', 't')
            ->join('t.czechWord', 'cw')
            ->orderBy('rw.content', 'ASC')
            ->getQuery();

        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage($maxPerPage);
        $paginator->setCurrentPage($page);

        return $paginator;
    }

    /**
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
}

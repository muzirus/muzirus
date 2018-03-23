<?php

namespace App\Repository;

use App\Entity\LogEntry;
use App\Entity\LogEntryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Doctrine\RegistryInterface;

class LogEntryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LogEntry::class);
    }

    /**
     * @return Pagerfanta|LogEntryInterface[]
     */
    public function findAsPaginator(int $page, int $maxPerPage = 10): Pagerfanta
    {
        $query = $this
            ->createQueryBuilder('le')
            ->select('le, c, cw, rw, s, st, t, te')
            ->leftJoin('le.category', 'c')
            ->leftJoin('le.czechWord', 'cw')
            ->leftJoin('le.russianWord', 'rw')
            ->leftJoin('le.source', 's')
            ->leftJoin('le.sourceType', 'st')
            ->leftJoin('le.translation', 't')
            ->leftJoin('le.translationExample', 'te')
            ->orderBy('le.createdAt', 'DESC')
            ->getQuery();

        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage($maxPerPage);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
}

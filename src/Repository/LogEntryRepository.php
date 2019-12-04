<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\LogEntry;
use App\Entity\LogEntryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

class LogEntryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogEntry::class);
    }

    /**
     * @return Pagerfanta|LogEntryInterface[]
     */
    public function findAsPaginatorOptimizedForAdminActivityTimeline(int $page, int $maxPerPage = 10): Pagerfanta
    {
        $query = $this
            ->createQueryBuilder('le')
            ->select([
                'le',
                'partial c.{id, title}',
                'partial cw.{id, content}',
                'partial rw.{id, content}',
                'partial s.{id, title}',
                'partial st.{id, title}',
                'partial t.{id, czechWord, russianWord}',
                'partial te.{id, czechWordSentence, russianWordSentence}',
            ])
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

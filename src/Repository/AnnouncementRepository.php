<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Announcement;
use App\Entity\AnnouncementInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class AnnouncementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Announcement::class);
    }

    /**
     * @return AnnouncementInterface[]
     */
    public function findAllWithAuthorsInDescendingOrder(): array
    {
        return $this->createQueryBuilder('a')
            ->select(['a', 'au'])
            ->leftJoin('a.author', 'au')
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}

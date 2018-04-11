<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Source;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
    public function findAllWithSourceTypes(): array
    {
        return $this->createQueryBuilder('s')
            ->select(['s', 'st'])
            ->join('s.type', 'st')
            ->orderBy('s.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\SourceType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class SourceTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SourceType::class);
    }

    /**
     * @return SourceType[]
     */
    public function getAll(): array
    {
        return $this->createQueryBuilder('st')
            ->orderBy('st.title', 'ASC')
            ->getQuery()
            ->getResult();
    }
}

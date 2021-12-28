<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\TranslationExample;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TranslationExampleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TranslationExample::class);
    }

    /**
     * @return TranslationExample[]
     */
    public function findAllWithTranslationAndWords(): array
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
}

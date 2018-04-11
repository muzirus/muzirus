<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Translation;
use App\Entity\TranslationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TranslationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Translation::class);
    }

    /**
     * @return TranslationInterface[]
     */
    public function findAllWithTranslationExamplesAndWords(): array
    {
        return $this
            ->createQueryBuilder('t')
            ->select(['t', 'te', 'rw', 'cw'])
            ->leftJoin('t.translationExamples', 'te')
            ->leftJoin('t.russianWord', 'rw')
            ->leftJoin('t.czechWord', 'cw')
            ->getQuery()
            ->getResult();
    }
}

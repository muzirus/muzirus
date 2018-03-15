<?php

namespace App\Repository;

use App\Entity\Translation;
use App\Entity\TranslationInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
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
    public function getAll(): array
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

    /**
     * @return Pagerfanta|TranslationInterface[]
     */
    public function findWithWordsAsPaginator(int $page, int $maxPerPage = 10): Pagerfanta
    {
        $query = $this
            ->createQueryBuilder('t')
            ->select(['t', 'rw', 'cw'])
            ->join('t.russianWord', 'rw')
            ->join('t.czechWord', 'cw')
            ->getQuery();


        $paginator = new Pagerfanta(new DoctrineORMAdapter($query));
        $paginator->setMaxPerPage($maxPerPage);
        $paginator->setCurrentPage($page);

        return $paginator;
    }

    /**
     * @return TranslationInterface[]
     */
    public function findByStartingLettersOfRussianWord(string $letters): array
    {
        return $this->createQueryBuilder('t')
            ->select('t, rw, cw')
            ->join('t.russianWord', 'rw')
            ->join('t.czechWord', 'cw')
            ->where('rw.content LIKE :letters')
            ->setParameter('letters', "%${letters}")
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return TranslationInterface[]
     */
    public function findByStartingLettersOfCzechWord(string $letters): array
    {
        return $this->createQueryBuilder('t')
            ->select('t, rw, cw')
            ->join('t.russianWord', 'rw')
            ->join('t.czechWord', 'cw')
            ->where('cw.content LIKE :letters')
            ->setParameter('letters', "%${letters}")
            ->getQuery()
            ->getArrayResult();
    }
}

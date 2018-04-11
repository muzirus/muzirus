<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\CzechWord;
use App\Entity\CzechWordInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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
    public function findAllOptimizedForAdminWordList(): array
    {
        return $this
            ->createQueryBuilder('w')
            ->select([
                'partial w.{id, content, languageNoteInflection, languageNoteExceptionToInflection, languageNoteGender, statusLight, imported, createdAt, updatedAt}',
                'partial t.{id}',
            ])
            ->join('w.translations', 't')
            ->orderBy('w.content', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return CzechWordInterface[]
     */
    public function findStartingWith(string $startsWith): array
    {
        $queryBuilder = $this->createQueryBuilder('cw');

        $queryBuilder
            ->join('cw.translations', 't')
            ->where('cw.content LIKE :like')
            ->setParameter('like', "${startsWith}%")
            ->orderBy('cw.content', 'ASC');

        if ($startsWith === 'c') {
            $queryBuilder
                ->andWhere('cw.content NOT LIKE :notLike')
                ->setParameter('notLike', 'ch%');
        }

        return $queryBuilder->getQuery()
            ->getResult();
    }

    /**
     * @param CzechWordInterface $word
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @return CzechWordInterface|null
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
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @return CzechWordInterface|null
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

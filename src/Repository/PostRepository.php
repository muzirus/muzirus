<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Post;
use App\Entity\PostInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PostInterface[] findAll()
 * @method PostInterface|null findOneBy(array $criteria, array $orderBy = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function findOneBySlug(string $slug): ?PostInterface
    {
        return $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneBySlugWithAuthor(string $slug): ?PostInterface
    {
        return $this->createQueryBuilder('p')
            ->select('p', 'au')
            ->leftJoin('p.author', 'au')
            ->where('p.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

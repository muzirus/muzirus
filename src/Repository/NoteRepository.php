<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\ORM\EntityRepository;

class NoteRepository extends EntityRepository
{
    /**
     * @return Note[]
     */
    public function getAll(): array
    {
        return $this->findBy([], ['createdAt' => 'DESC']);
    }

    /**
     * @param int $id
     * @return Note
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneById(int $id): Note
    {
        return $this
            ->createQueryBuilder('n')
            ->where('n.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }
}

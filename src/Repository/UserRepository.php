<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return User
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneById(int $id): User
    {
        return $this->createQueryBuilder('u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @param string $email
     * @return User
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneByEmail(string $email): User
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @param string $email
     * @param string $passwordRecoveryKey
     * @return User
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneByEmailAndPasswordRecoveryKey(string $email, string $passwordRecoveryKey): User
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->andWhere('u.passwordRecoveryKey = :passwordRecoveryKey')
            ->setParameter('email', $email)
            ->setParameter('passwordRecoveryKey', $passwordRecoveryKey)
            ->getQuery()
            ->getSingleResult();
    }
}

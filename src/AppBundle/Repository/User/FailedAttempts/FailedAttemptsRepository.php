<?php

namespace HGT\AppBundle\Repository\User\FailedAttempts;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\FailedAttempts\FailedAttempts;

class FailedAttemptsRepository extends ServiceEntityRepository
{
    /**
     * FailedAttemptsRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FailedAttempts::class);
    }

    /**
     * @param FailedAttempts $failedAttempts
     */
    public function add(FailedAttempts $failedAttempts)
    {
        $this->getEntityManager()->persist($failedAttempts);
    }

    /**
     * @param string $username
     * @return FailedAttempts|null|object
     */
    public function findByUsername($username)
    {
        return $this->findOneBy(compact('username'));
    }

    /**
     * @param string $username
     */
    public function removeByUsername($username)
    {
        $self = FailedAttempts::class;
        $query = $this->getEntityManager()->createQuery("DELETE FROM {$self} fa WHERE fa.username = :username");

        $query->execute(compact('username'));
    }
}

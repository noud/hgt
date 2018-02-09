<?php

namespace HGT\AppBundle\Repository\User\FailedAttempts;

use Doctrine\ORM\EntityRepository;
use HGT\Application\User\FailedAttempts\FailedAttempts;

class FailedAttemptsRepository extends EntityRepository
{
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

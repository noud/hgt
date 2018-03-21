<?php

namespace HGT\AppBundle\Repository\User\LockedAccount;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\LockedAccount\LockedAccount;

class LockedAccountRepository extends ServiceEntityRepository
{
    /**
     * LockedAccountRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LockedAccount::class);
    }

    /**
     * @param string $username
     * @return LockedAccount|null|object
     */
    public function findByUsername($username)
    {
        return $this->findOneBy(compact('username'));
    }

    /**
     * @param LockedAccount $lockedAccount
     */
    public function add(LockedAccount $lockedAccount)
    {
        $this->getEntityManager()->persist($lockedAccount);
    }

    /**
     * @param string $username
     */
    public function removeByUsername($username)
    {
        $self = LockedAccount::class;
        $query = $this->getEntityManager()->createQuery("DELETE FROM {$self} la WHERE la.username = :username");

        $query->execute(compact('username'));
    }
}

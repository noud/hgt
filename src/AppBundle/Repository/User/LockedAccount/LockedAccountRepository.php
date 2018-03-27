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
     * @param string $ip
     * @return LockedAccount|null|object
     */
    public function findByIp($ip)
    {
        return $this->findOneBy(['ipAddress' => $ip]);
    }

    /**
     * @param LockedAccount $lockedAccount
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     */
    public function add(LockedAccount $lockedAccount)
    {
        $this->getEntityManager()->persist($lockedAccount);
    }

    /**
     * @param string $ip
     */
    public function removeByIp($ip)
    {
        $self = LockedAccount::class;
        $query = $this->getEntityManager()->createQuery("DELETE FROM {$self} la WHERE la.ipAddress = :ip");

        $query->execute(compact('ip'));
    }
}

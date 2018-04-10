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
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     */
    public function add(FailedAttempts $failedAttempts)
    {
        dump($failedAttempts);
        $this->getEntityManager()->persist($failedAttempts);
    }

    /**
     * @param string $ip
     * @return FailedAttempts|null|object
     */
    public function findByIp($ip)
    {
        return $this->findOneBy(['ipAddress' => $ip]);
    }

    /**
     * @param string $ip
     */
    public function removeByIp($ip)
    {
        $self = FailedAttempts::class;
        $query = $this->getEntityManager()->createQuery("DELETE FROM {$self} fa WHERE fa.ipAddress = :ip");

        $query->execute(compact('ip'));
    }
}

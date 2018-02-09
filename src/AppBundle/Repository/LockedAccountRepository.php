<?php

namespace AppBundle\Repository;

use AppBundle\Entity\LockedAccount;
use Doctrine\ORM\EntityRepository;

class LockedAccountRepository extends EntityRepository
{
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

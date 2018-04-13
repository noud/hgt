<?php

namespace HGT\AppBundle\Repository\User\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\User\CmsUser;

class CmsUserRepository extends ServiceEntityRepository
{
    /**
     * CmsUserRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CmsUser::class);
    }

    /**
     * @param $id
     * @return CmsUser|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * Add a new user
     * @param CmsUser $user
     */
    public function add(CmsUser $user)
    {
        $this->getEntityManager()->persist($user);
    }

    /**
     * @param $email string
     * @return CmsUser|null|object
     */
    public function getUserByEmail($email)
    {
        return $this->findOneBy(
            compact('email')
        );
    }

    /**
     * Remove a user
     * @param CmsUser $user
     */
    public function remove(CmsUser $user)
    {
        $this->getEntityManager()->remove($user);
    }

    /**
     * @param $email string
     * @return bool
     */
    public function emailExists($email)
    {
        $user = $this->findOneBy(array('email' => $email));
        return is_object($user);
    }
}

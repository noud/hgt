<?php

namespace HGT\AppBundle\Repository\User\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\User\User;

class UserRepository extends ServiceEntityRepository
{
    /**
     * UserRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param $id
     * @return User|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * Add a new user
     * @param User $user
     */
    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
    }

    /**
     * @param $email string
     * @return User|null|object
     */
    public function getUserByEmail($email)
    {
        return $this->findOneBy(
            compact('email')
        );
    }

    /**
     * Remove a user
     * @param User $user
     */
    public function remove(User $user)
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

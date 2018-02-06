<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @param $id
     * @return User
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
     * @return User|null
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

<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Customer;
use Doctrine\ORM\EntityRepository;

class CustomerRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Customer|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Customer $customer
     */
    public function add(Customer $customer)
    {
        $this->getEntityManager()->persist($customer);
    }

    /**
     * @param Customer $customer
     */
    public function remove(Customer $customer)
    {
        $this->getEntityManager()->remove($customer);
    }

    /**
     * @param $username string
     * @return Customer|object|null
     */
    public function getByUsername($username)
    {
        return $this->findOneBy(compact('username'));
    }
}

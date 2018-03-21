<?php

namespace HGT\AppBundle\Repository\User\Customer;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\Customer\Customer;

class CustomerRepository extends ServiceEntityRepository
{
    /**
     * CustomerRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

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

    /**
     * @param Customer $customer
     * @return string
     */
    public function getDeliveryDays(Customer $customer)
    {
        return $this->get($customer)->getDeliveryDays();
    }
}

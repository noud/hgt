<?php

namespace HGT\AppBundle\Repository\User\CustomerOrder;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use HGT\Application\User\CustomerOrder\CustomerOrder;

class CustomerOrderRepository extends ServiceEntityRepository
{
    /**
     * @param $id
     * @return CustomerOrder|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CustomerOrder $customerOrder
     */
    public function add(CustomerOrder $customerOrder)
    {
        $this->getEntityManager()->persist($customerOrder);
    }

    /**
     * @param CustomerOrder $customerOrder
     */
    public function remove(CustomerOrder $customerOrder)
    {
        $this->getEntityManager()->remove($customerOrder);
    }
}

<?php

namespace AppBundle\Repository;

use AppBundle\Entity\CustomerOrder;
use Doctrine\ORM\EntityRepository;

class CustomerOrderRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerOrder
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

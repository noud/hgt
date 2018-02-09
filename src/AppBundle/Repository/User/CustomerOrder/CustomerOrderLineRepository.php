<?php

namespace HGT\AppBundle\Repository\User\CustomerOrder;

use Doctrine\ORM\EntityRepository;
use HGT\Application\User\CustomerOrder\CustomerOrderLine;

class CustomerOrderLineRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerOrderLine|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CustomerOrderLine $customerOrderLine
     */
    public function add(CustomerOrderLine $customerOrderLine)
    {
        $this->getEntityManager()->persist($customerOrderLine);
    }

    /**
     * @param CustomerOrderLine $customerOrderLine
     */
    public function remove(CustomerOrderLine $customerOrderLine)
    {
        $this->getEntityManager()->remove($customerOrderLine);
    }
}

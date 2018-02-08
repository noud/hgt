<?php

namespace AppBundle\Repository;

use AppBundle\Entity\CustomerOrderLine;
use Doctrine\ORM\EntityRepository;

class CustomerOrderLineRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerOrderLine
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
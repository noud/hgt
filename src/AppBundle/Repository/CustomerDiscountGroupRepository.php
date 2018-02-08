<?php

namespace AppBundle\Repository;

use AppBundle\Entity\CustomerDiscountGroup;
use Doctrine\ORM\EntityRepository;

class CustomerDiscountGroupRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerDiscountGroup
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CustomerDiscountGroup $customerDiscountGroup
     */
    public function add(CustomerDiscountGroup $customerDiscountGroup)
    {
        $this->getEntityManager()->persist($customerDiscountGroup);
    }

    /**
     * @param CustomerDiscountGroup $customerDiscountGroup
     */
    public function remove(CustomerDiscountGroup $customerDiscountGroup)
    {
        $this->getEntityManager()->remove($customerDiscountGroup);
    }
}
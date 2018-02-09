<?php

namespace HGT\AppBundle\Repository\User\CustomerDiscountGroup;

use Doctrine\ORM\EntityRepository;
use HGT\Application\User\CustomerDiscountGroup\CustomerDiscountGroup;

class CustomerDiscountGroupRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerDiscountGroup|object
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

<?php

namespace HGT\AppBundle\Repository\User\CustomerPriceGroup;

use Doctrine\ORM\EntityRepository;
use HGT\Application\User\CustomerPriceGroup\CustomerPriceGroup;

class CustomerPriceGroupRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerPriceGroup
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CustomerPriceGroup $customerPriceGroup
     */
    public function add(CustomerPriceGroup $customerPriceGroup)
    {
        $this->getEntityManager()->persist($customerPriceGroup);
    }

    /**
     * @param CustomerPriceGroup $customerPriceGroup
     */
    public function remove(CustomerPriceGroup $customerPriceGroup)
    {
        $this->getEntityManager()->remove($customerPriceGroup);
    }
}

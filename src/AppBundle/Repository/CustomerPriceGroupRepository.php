<?php

namespace AppBundle\Repository;

use AppBundle\Entity\CustomerPriceGroup;
use Doctrine\ORM\EntityRepository;

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
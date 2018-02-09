<?php

namespace HGT\AppBundle\Repository\User\CustomerTaxGroup;

use Doctrine\ORM\EntityRepository;
use HGT\Application\User\CustomerTaxGroup\CustomerTaxGroup;

class CustomerTaxGroupRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerTaxGroup|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CustomerTaxGroup $customerTaxGroup
     */
    public function add(CustomerTaxGroup $customerTaxGroup)
    {
        $this->getEntityManager()->persist($customerTaxGroup);
    }

    /**
     * @param CustomerTaxGroup $customerTaxGroup
     */
    public function remove(CustomerTaxGroup $customerTaxGroup)
    {
        $this->getEntityManager()->remove($customerTaxGroup);
    }
}

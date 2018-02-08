<?php

namespace AppBundle\Repository;

use AppBundle\Entity\CustomerTaxGroup;
use Doctrine\ORM\EntityRepository;

class CustomerTaxGroupRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerTaxGroup
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

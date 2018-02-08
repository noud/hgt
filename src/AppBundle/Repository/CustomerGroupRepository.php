<?php

namespace AppBundle\Repository;

use AppBundle\Entity\CustomerGroup;
use Doctrine\ORM\EntityRepository;

class CustomerGroupRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerGroup
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CustomerGroup $customerGroup
     */
    public function add(CustomerGroup $customerGroup)
    {
        $this->getEntityManager()->persist($customerGroup);
    }

    /**
     * @param CustomerGroup $customerGroup
     */
    public function remove(CustomerGroup $customerGroup)
    {
        $this->getEntityManager()->remove($customerGroup);
    }
}
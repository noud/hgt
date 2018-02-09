<?php

namespace HGT\AppBundle\Repository\User\CustomerGroup;

use Doctrine\ORM\EntityRepository;
use HGT\Application\User\CustomerGroup\CustomerGroup;

class CustomerGroupRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CustomerGroup|object
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

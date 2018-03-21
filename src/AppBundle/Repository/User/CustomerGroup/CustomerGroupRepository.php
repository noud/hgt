<?php

namespace HGT\AppBundle\Repository\User\CustomerGroup;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\CustomerGroup\CustomerGroup;

class CustomerGroupRepository extends ServiceEntityRepository
{
    /**
     * CustomerGroupRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerGroup::class);
    }

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

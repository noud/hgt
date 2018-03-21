<?php

namespace HGT\AppBundle\Repository\User\CustomerDiscountGroup;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\CustomerDiscountGroup\CustomerDiscountGroup;

class CustomerDiscountGroupRepository extends ServiceEntityRepository
{
    /**
     * CustomerDiscountGroupRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerDiscountGroup::class);
    }

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

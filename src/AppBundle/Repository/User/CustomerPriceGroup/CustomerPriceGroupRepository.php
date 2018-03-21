<?php

namespace HGT\AppBundle\Repository\User\CustomerPriceGroup;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\CustomerPriceGroup\CustomerPriceGroup;

class CustomerPriceGroupRepository extends ServiceEntityRepository
{
    /**
     * CustomerPriceGroupRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerPriceGroup::class);
    }

    /**
     * @param $id
     * @return CustomerPriceGroup|object
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

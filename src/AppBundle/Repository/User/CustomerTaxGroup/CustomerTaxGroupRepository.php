<?php

namespace HGT\AppBundle\Repository\User\CustomerTaxGroup;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\CustomerTaxGroup\CustomerTaxGroup;

class CustomerTaxGroupRepository extends ServiceEntityRepository
{
    /**
     * CustomerTaxGroupRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerTaxGroup::class);
    }

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

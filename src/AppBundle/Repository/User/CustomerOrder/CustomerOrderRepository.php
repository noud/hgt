<?php

namespace HGT\AppBundle\Repository\User\CustomerOrder;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\CustomerOrder\CustomerOrder;

class CustomerOrderRepository extends ServiceEntityRepository
{
    /**
     * CustomerOrderRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerOrder::class);
    }

    /**
     * @param $id
     * @return CustomerOrder|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CustomerOrder $customerOrder
     */
    public function add(CustomerOrder $customerOrder)
    {
        $this->getEntityManager()->persist($customerOrder);
    }

    /**
     * @param CustomerOrder $customerOrder
     */
    public function remove(CustomerOrder $customerOrder)
    {
        $this->getEntityManager()->remove($customerOrder);
    }
}

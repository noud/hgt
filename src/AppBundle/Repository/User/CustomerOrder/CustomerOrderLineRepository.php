<?php

namespace HGT\AppBundle\Repository\User\CustomerOrder;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\Customer\Customer;
use HGT\Application\User\CustomerOrder\CustomerOrder;
use HGT\Application\User\CustomerOrder\CustomerOrderLine;

class CustomerOrderLineRepository extends ServiceEntityRepository
{
    /**
     * CustomerOrderLineRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerOrderLine::class);
    }

    /**
     * @param $id
     * @return CustomerOrderLine|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CustomerOrderLine $customerOrderLine
     */
    public function add(CustomerOrderLine $customerOrderLine)
    {
        $this->getEntityManager()->persist($customerOrderLine);
    }

    /**
     * @param CustomerOrderLine $customerOrderLine
     */
    public function remove(CustomerOrderLine $customerOrderLine)
    {
        $this->getEntityManager()->remove($customerOrderLine);
    }

    /**
     * @param CustomerOrder $customerOrder
     * @return CustomerOrderLine[]
     */
    public function getByCustomerOrder(CustomerOrder $customerOrder)
    {
        $query = $this->createQueryBuilder('col')
            ->where('col.customer_order = :co_id')
            ->setParameter('co_id', $customerOrder->getId())
        ;
        return $query->getQuery()->getResult();
    }
}

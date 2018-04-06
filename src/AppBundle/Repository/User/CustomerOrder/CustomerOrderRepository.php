<?php

namespace HGT\AppBundle\Repository\User\CustomerOrder;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\Customer\Customer;
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

    /**
     * @param Customer $customer
     * @return CustomerOrder[]
     */
    public function getCustomerOrders(Customer $customer, $delivered = false)
    {
        $query = $this->createQueryBuilder('co')
            ->where('co.customer_group = :cg_id')
            ->setParameter('cg_id', $customer->getCustomerGroup()->getId());

        if (!$delivered) {
            $query->andWhere('co.delivery_date => CURRENT_DATE()');
        } else {
            $query->andWhere('co.delivery_date < CURRENT_DATE()');
        }

        return $query->getQuery()->getResult();
    }
}

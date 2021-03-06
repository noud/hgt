<?php

namespace HGT\AppBundle\Repository\User\CustomerProduct;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\User\CustomerGroup\CustomerGroup;
use HGT\Application\User\CustomerProduct\CustomerProduct;

class CustomerProductRepository extends ServiceEntityRepository
{
    /**
     * CustomerProductRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomerProduct::class);
    }

    /**
     * @param $id
     * @return CustomerProduct|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CustomerProduct $customerProduct
     */
    public function add(CustomerProduct $customerProduct)
    {
        $this->getEntityManager()->persist($customerProduct);
    }

    /**
     * @param CustomerProduct $customerProduct
     */
    public function remove(CustomerProduct $customerProduct)
    {
        $this->getEntityManager()->remove($customerProduct);
    }

    /**
     * @param CustomerGroup $customerGroup
     * @return array
     */
    public function getCustomerProducts($customerGroup)
    {
        $query = $this->createQueryBuilder('cp')
            ->leftJoin('cp.product', 'p')
            ->where('cp.customer_group = :customer_group')
            ->setParameter('customer_group', $customerGroup->getId())
            ->andWhere('p.enabled = true')
            ->orderBy('cp.priority')
        ;

        return $query->getQuery()->getResult();
    }
}

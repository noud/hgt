<?php

namespace HGT\AppBundle\Repository\Catalog\Tax;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Catalog\Product\ProductTaxGroup;
use HGT\Application\Catalog\Tax\Tax;
use HGT\Application\User\CustomerTaxGroup\CustomerTaxGroup;

class TaxRepository extends ServiceEntityRepository
{
    /**
     * TaxRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tax::class);
    }

    /**
     * @param $id
     * @return Tax|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Tax $tax
     */
    public function add(Tax $tax)
    {
        $this->getEntityManager()->persist($tax);
    }

    /**
     * @param Tax $tax
     */
    public function remove(Tax $tax)
    {
        $this->getEntityManager()->remove($tax);
    }

    /**
     * @param CustomerTaxGroup $customerTaxGroup
     * @param ProductTaxGroup $productTaxGroup
     * @return Tax|object
     */
    public function getTaxByGroupIds(CustomerTaxGroup $customerTaxGroup, ProductTaxGroup $productTaxGroup)
    {
        return $this->findOneBy([
            'customer_tax_group' => $customerTaxGroup,
            'product_tax_group' => $productTaxGroup
        ]);
    }
}

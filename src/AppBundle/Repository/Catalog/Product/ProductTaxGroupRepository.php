<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Catalog\Product\ProductTaxGroup;

class ProductTaxGroupRepository extends ServiceEntityRepository
{
    /**
     * ProductTaxGroupRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductTaxGroup::class);
    }

    /**
     * @param $id
     * @return ProductTaxGroup|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param ProductTaxGroup $productTaxGroup
     */
    public function add(ProductTaxGroup $productTaxGroup)
    {
        $this->getEntityManager()->persist($productTaxGroup);
    }

    /**
     * @param ProductTaxGroup $productTaxGroup
     */
    public function remove(ProductTaxGroup $productTaxGroup)
    {
        $this->getEntityManager()->remove($productTaxGroup);
    }
}

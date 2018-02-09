<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Product\ProductTaxGroup;

class ProductTaxGroupRepository extends EntityRepository
{
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

<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Product\ProductCategory;

class ProductCategoryRepository extends EntityRepository
{
    /**
     * @param $id
     * @return ProductCategory|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param ProductCategory $productCategory
     */
    public function add(ProductCategory $productCategory)
    {
        $this->getEntityManager()->persist($productCategory);
    }

    /**
     * @param ProductCategory $productCategory
     */
    public function remove(ProductCategory $productCategory)
    {
        $this->getEntityManager()->remove($productCategory);
    }
}

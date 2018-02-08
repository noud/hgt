<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ProductCategory;
use Doctrine\ORM\EntityRepository;

class ProductCategoryRepository extends EntityRepository
{
    /**
     * @param $id
     * @return ProductCategory
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
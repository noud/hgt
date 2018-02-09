<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;

class ProductUnitOfMeasureRepository extends EntityRepository
{
    /**
     * @param $id
     * @return ProductUnitOfMeasure|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param ProductUnitOfMeasure $productUnitOfMeasure
     */
    public function add(ProductUnitOfMeasure $productUnitOfMeasure)
    {
        $this->getEntityManager()->persist($productUnitOfMeasure);
    }

    /**
     * @param ProductUnitOfMeasure $productUnitOfMeasure
     */
    public function remove(ProductUnitOfMeasure $productUnitOfMeasure)
    {
        $this->getEntityManager()->remove($productUnitOfMeasure);
    }
}

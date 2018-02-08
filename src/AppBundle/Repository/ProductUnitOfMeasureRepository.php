<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ProductUnitOfMeasure;
use Doctrine\ORM\EntityRepository;

class ProductUnitOfMeasureRepository extends EntityRepository
{
    /**
     * @param $id
     * @return ProductUnitOfMeasure
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
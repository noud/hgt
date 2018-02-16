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

    /**
     * @param $product_id int
     * @return array
     */
    public function getProductUnitOfMeasureByProductId($product_id)
    {
        return $this->findBy(
            ['product' => $product_id]
        );
    }

    /**
     * @param $product_id
     * @param $unit_of_measure_id
     * @return object
     */
    public function getProductUnitOfMeasureForProductPrice($product_id, $unit_of_measure_id)
    {
        $return = $this->findOneBy(
            [
                'product' => $product_id,
                'unit_of_measure' => $unit_of_measure_id
            ]
        );

        dump($return);
        return $return;
    }
}

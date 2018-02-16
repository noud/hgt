<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductUnitOfMeasureRepository;

class ProductUnitOfMeasureService
{
    /**
     * @var ProductUnitOfMeasureRepository
     */
    private $productUnitOfMeasureRepository;

    /**
     * ProductUnitOfMeasureService constructor.
     * @param ProductUnitOfMeasureRepository $productUnitOfMeasureRepository
     */
    public function __construct(ProductUnitOfMeasureRepository $productUnitOfMeasureRepository)
    {
        $this->productUnitOfMeasureRepository = $productUnitOfMeasureRepository;
    }

    /**
     * @param $product_id int
     * @return array
     */
    public function getProductUnitOfMeasures($product_id)
    {
        return $this->productUnitOfMeasureRepository->getProductUnitOfMeasureByProductId($product_id);
    }

    /**
     * @param $product_id
     * @param $unit_of_measure_id
     * @return object
     */
    public function getProductUnitOfMeasure($product_id, $unit_of_measure_id)
    {
        return $this->productUnitOfMeasureRepository->getProductUnitOfMeasureForProductPrice($product_id, $unit_of_measure_id);
    }
}

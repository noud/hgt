<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductUnitOfMeasureRepository;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;
use HGT\Application\Catalog\Product\UnitOfMeasure;

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
     * @param Product $product
     * @return array|ProductUnitOfMeasure[]
     */
    public function getProductUnitOfMeasures(Product $product)
    {
        return $this->productUnitOfMeasureRepository->getProductUnitOfMeasureByProduct($product);
    }

    /**
     * @param Product $product
     * @param UnitOfMeasure $unit_of_measure
     * @return ProductUnitOfMeasure|null|object
     */
    public function getProductUnitOfMeasure(Product $product, UnitOfMeasure $unit_of_measure)
    {
        return $this->productUnitOfMeasureRepository->getProductUnitOfMeasureForProductPrice(
            $product,
            $unit_of_measure
        );
    }

    /**
     * @param Product $product
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilderForProductUnitOfMeasures(Product $product)
    {
        return $this->productUnitOfMeasureRepository->getQueryBuilderForProductUnitOfMeasures($product);
    }
}

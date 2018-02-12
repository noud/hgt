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
}

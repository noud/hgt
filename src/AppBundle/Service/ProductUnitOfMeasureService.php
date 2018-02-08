<?php

namespace AppBundle\Service;

use AppBundle\Repository\ProductUnitOfMeasureRepository;

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
<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductPriceRepository;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;
use HGT\Application\User\Customer\Customer;

class ProductPriceService
{
    /**
     * @var ProductPriceRepository
     */
    private $priceRepository;

    /**
     * @var ProductUnitOfMeasureService
     */
    private $productUnitOfMeasureService;

    /**
     * ProductPriceService constructor.
     * @param ProductPriceRepository $priceRepository
     * @param ProductUnitOfMeasureService $productUnitOfMeasureService
     */
    public function __construct(ProductPriceRepository $priceRepository, ProductUnitOfMeasureService $productUnitOfMeasureService)
    {
        $this->priceRepository = $priceRepository;
        $this->productUnitOfMeasureService = $productUnitOfMeasureService;
    }

    /**
     * @param $product_id
     * @param $unit_of_measure_id
     * @param int $qty
     * @param null $date
     * @return float
     */
    public function getUnitPriceForCustomer($product_id, $unit_of_measure_id, $qty = 1, $date = null)
    {
        /** @var ProductUnitOfMeasure $productUnitOfMeasure */
        $productUnitOfMeasure = $this->productUnitOfMeasureService->getProductUnitOfMeasure($product_id, $unit_of_measure_id);

        if($productUnitOfMeasure !== null) {
            return $productUnitOfMeasure->getQtyPerUnitOfMeasure();
        }

        return null;
    }
}

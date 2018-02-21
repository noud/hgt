<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductPriceRepository;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\Product\ProductPrice;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;
use HGT\Application\Catalog\Product\UnitOfMeasure;
use HGT\Application\User\Customer\Customer;

class ProductPriceService
{
    /**
     * @var ProductUnitOfMeasureService
     */
    private $productUnitOfMeasureService;

    /**
     * @var ProductPriceRepository
     */
    private $productPriceRepository;

    /**
     * @var ProductService
     */
    private $productService;

    /**
     * ProductPriceService constructor.
     * @param ProductUnitOfMeasureService $productUnitOfMeasureService
     * @param ProductPriceRepository $productPriceRepository
     * @param ProductService $productService
     */
    public function __construct(
        ProductUnitOfMeasureService $productUnitOfMeasureService,
        ProductPriceRepository $productPriceRepository,
        ProductService $productService
    ) {
        $this->productUnitOfMeasureService = $productUnitOfMeasureService;
        $this->productPriceRepository = $productPriceRepository;
        $this->productService = $productService;
    }

    /**
     * @param Customer $customer
     * @param Product $product
     * @param UnitOfMeasure $unit_of_measure
     * @param int $qty
     * @param \DateTime $date
     * @return float|null
     */
    public function getUnitPriceForCustomer(
        Customer $customer,
        Product $product,
        UnitOfMeasure $unit_of_measure,
        $qty = 1,
        $date = null
    ) {
        $foundPrice = null;

        /** @var ProductUnitOfMeasure $productUnitOfMeasure */
        $productUnitOfMeasure = $this->productUnitOfMeasureService->getProductUnitOfMeasure($product, $unit_of_measure);

        if ($productUnitOfMeasure !== null) {

            foreach (array("0", "1") as $is_action_price) {

                $activeProductPrices = $this->productPriceRepository->getActiveProductPrices($product, $unit_of_measure,
                    $is_action_price, $date);

                foreach ($activeProductPrices AS $activeProductPrice) {

                    // check minimum qty
                    if ($activeProductPrice->getMinimumQty() > $qty) {
                        continue;
                    }

                    if ($activeProductPrice->getPriceType() == ProductPrice::PRICE_TYPE_SELECTION && $activeProductPrice->getSelectionCode() == $customer->getSelectionCode()) {
                        // if($foundPrice === null || $productPrice->getUnitPrice() < $foundPrice->getUnitPrice())
                        if ($foundPrice === null || $activeProductPrice->getUnitPrice() < $foundPrice) {
                            $foundPrice = $activeProductPrice->getUnitPrice();
                        }
                    }

                    if ($activeProductPrice->getPriceType() == ProductPrice::PRICE_TYPE_CUSTOMER_GROUP && $activeProductPrice->getCustomerGroup() == $customer->getCustomerGroup()) {
                        if ($foundPrice === null || $activeProductPrice->getUnitPrice() < $foundPrice) {
                            $foundPrice = $activeProductPrice->getUnitPrice();
                        }
                    }

                    if ($activeProductPrice->getPriceType() == ProductPrice::PRICE_TYPE_CUSTOMER_PRICE_GROUP && $activeProductPrice->getCustomerPriceGroup() == $customer->getCustomerPriceGroup()) {
                        if ($foundPrice === null || $activeProductPrice->getUnitPrice() < $foundPrice) {
                            $foundPrice = $activeProductPrice->getUnitPrice();
                        }
                    }

                    if ($activeProductPrice->getPriceType() == ProductPrice::PRICE_TYPE_GLOBAL) {
                        if ($foundPrice === null || $activeProductPrice->getUnitPrice() < $foundPrice) {
                            $foundPrice = $activeProductPrice->getUnitPrice();
                        }
                    }
                }
            }

            //get current unit of measure
            if ($foundPrice === null) {
                $foundPrice = $product->getPrice() * $productUnitOfMeasure->getQtyPerUnitOfMeasure();
            }

            return $foundPrice;
        }

        return null;
    }
}

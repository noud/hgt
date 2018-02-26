<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductPriceRepository;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\Product\ProductPrice;
use HGT\Application\Catalog\Product\ProductTaxGroup;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;
use HGT\Application\Catalog\Product\UnitOfMeasure;
use HGT\Application\User\Customer\Customer;
use HGT\Application\User\CustomerTaxGroup\CustomerTaxGroup;

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
     * @var TaxService
     */
    private $taxService;

    /**
     * ProductPriceService constructor.
     * @param ProductUnitOfMeasureService $productUnitOfMeasureService
     * @param ProductPriceRepository $productPriceRepository
     * @param ProductService $productService
     * @param TaxService $taxService
     */
    public function __construct(
        ProductUnitOfMeasureService $productUnitOfMeasureService,
        ProductPriceRepository $productPriceRepository,
        ProductService $productService,
        TaxService $taxService
    ) {
        $this->productUnitOfMeasureService = $productUnitOfMeasureService;
        $this->productPriceRepository = $productPriceRepository;
        $this->productService = $productService;
        $this->taxService = $taxService;
    }

    public function getActionProductPrice(
        Customer $customer,
        Product $product,
        UnitOfMeasure $unit_of_measure,
        $qty = 1
    ) {
        $unit_of_measure_ids = array();

        /** @var UnitOfMeasure $unitOfMeasure */
        if ($unit_of_measure === null) {
            foreach ($this->productUnitOfMeasureService->getProductUnitOfMeasures($product) as $unitOfMeasure) {
                $unit_of_measure_ids[] = $unitOfMeasure->getId();
            }
        } else {
            $unit_of_measure_ids[] = $unit_of_measure->getId();
        }

        $foundPrice = null;

        foreach ($unit_of_measure_ids as $unit_of_measure_id) {
            foreach ($this->getActiveProductPrices($product, $unit_of_measure, 1) as $productPrice) {
                if ($productPrice->getMinimumQty() > $qty) {
                    continue;
                }
                if ($productPrice->getPriceType() == ProductPrice::PRICE_TYPE_SELECTION &&
                    $productPrice->getSelectionCode() == $customer->getSelectionCode()) {
                    //if($foundPrice === null || $productPrice->getUnitPrice() < $foundPrice->getUnitPrice()) {
                    if ($foundPrice === null || $productPrice->getUnitPrice() < $foundPrice) {
                        $foundPrice = $productPrice;
                    }
                }
                if ($productPrice->getPriceType() == ProductPrice::PRICE_TYPE_CUSTOMER_GROUP &&
                    $productPrice->getCustomerGroup() == $customer->getCustomerGroup()) {
                    if ($foundPrice === null || $productPrice->getUnitPrice() < $foundPrice->getUnitPrice()) {
                        $foundPrice = $productPrice;
                    }
                }
                if ($productPrice->getPriceType() == ProductPrice::PRICE_TYPE_CUSTOMER_PRICE_GROUP &&
                    $productPrice->getCustomerPriceGroup() == $customer->getCustomerPriceGroup()) {
                    if ($foundPrice === null || $productPrice->getUnitPrice() < $foundPrice->getUnitPrice()) {
                        $foundPrice = $productPrice;
                    }
                }
                if ($productPrice->getPriceType() == ProductPrice::PRICE_TYPE_GLOBAL) {
                    if ($foundPrice === null || $productPrice->getUnitPrice() < $foundPrice->getUnitPrice()) {
                        $foundPrice = $productPrice;
                    }
                }
            }
        }

        return $foundPrice;
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
                $activeProductPrices = $this->productPriceRepository->getActiveProductPrices(
                    $product,
                    $unit_of_measure,
                    $is_action_price,
                    $date
                );

                foreach ($activeProductPrices as $activeProductPrice) {
                    if ($activeProductPrice->getMinimumQty() > $qty) {
                        continue;
                    }
                    if ($activeProductPrice->getPriceType() == ProductPrice::PRICE_TYPE_SELECTION &&
                        $activeProductPrice->getSelectionCode() == $customer->getSelectionCode()) {
                        // if($foundPrice === null || $productPrice->getUnitPrice() < $foundPrice->getUnitPrice())
                        if ($foundPrice === null || $activeProductPrice->getUnitPrice() < $foundPrice) {
                            $foundPrice = $activeProductPrice->getUnitPrice();
                        }
                    }
                    if ($activeProductPrice->getPriceType() == ProductPrice::PRICE_TYPE_CUSTOMER_GROUP &&
                        $activeProductPrice->getCustomerGroup() == $customer->getCustomerGroup()) {
                        if ($foundPrice === null || $activeProductPrice->getUnitPrice() < $foundPrice) {
                            $foundPrice = $activeProductPrice->getUnitPrice();
                        }
                    }
                    if ($activeProductPrice->getPriceType() == ProductPrice::PRICE_TYPE_CUSTOMER_PRICE_GROUP &&
                        $activeProductPrice->getCustomerPriceGroup() == $customer->getCustomerPriceGroup()) {
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

            if ($foundPrice === null) {
                $foundPrice = $product->getPrice() * $productUnitOfMeasure->getQtyPerUnitOfMeasure();
            }

            return $foundPrice;
        }

        return null;
    }

    /**
     * @param CustomerTaxGroup $customerTaxGroup
     * @param ProductTaxGroup $productTaxGroup
     * @return float
     */
    public function getTaxPercentage(CustomerTaxGroup $customerTaxGroup, ProductTaxGroup $productTaxGroup)
    {
        return $this->taxService->getTaxByGroupIds($customerTaxGroup, $productTaxGroup)->getPercentage();
    }

    /**
     * @param Product $product
     * @param UnitOfMeasure $unit_of_measure
     * @param int $is_action_price
     * @param \DateTime $date
     * @return array|ProductPrice[]
     */
    public function getActiveProductPrices(
        Product $product,
        UnitOfMeasure $unit_of_measure,
        $is_action_price = null,
        $date = null
    ) {
        return $this->productPriceRepository->getActiveProductPrices(
            $product,
            $unit_of_measure,
            $is_action_price,
            $date
        );
    }
}

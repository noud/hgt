<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Tax\TaxRepository;
use HGT\Application\Catalog\Product\ProductTaxGroup;
use HGT\Application\Catalog\Tax\Tax;
use HGT\Application\User\CustomerTaxGroup\CustomerTaxGroup;

class TaxService
{
    /**
     * @var TaxRepository
     */
    private $taxRepository;

    /**
     * TaxService constructor.
     * @param TaxRepository $taxRepository
     */
    public function __construct(TaxRepository $taxRepository)
    {
        $this->taxRepository = $taxRepository;
    }

    /**
     * @param CustomerTaxGroup $customerTaxGroup
     * @param ProductTaxGroup $productTaxGroup
     * @return Tax|object
     */
    public function getTaxByGroupIds(CustomerTaxGroup $customerTaxGroup, ProductTaxGroup $productTaxGroup)
    {
        return $this->taxRepository->getTaxByGroupIds($customerTaxGroup, $productTaxGroup);
    }
}

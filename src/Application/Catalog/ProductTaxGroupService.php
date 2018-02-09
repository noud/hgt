<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductTaxGroupRepository;

class ProductTaxGroupService
{
    /**
     * @var ProductTaxGroupRepository
     */
    private $productTaxGroupRepository;

    /**
     * ProductTaxGroupService constructor.
     * @param ProductTaxGroupRepository $productTaxGroupRepository
     */
    public function __construct(ProductTaxGroupRepository $productTaxGroupRepository)
    {
        $this->productTaxGroupRepository = $productTaxGroupRepository;
    }
}

<?php

namespace AppBundle\Service;

use AppBundle\Repository\ProductTaxGroupRepository;

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

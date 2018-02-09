<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductCategoryRepository;

class ProductCategoryService
{
    /**
     * @var ProductCategoryRepository
     */
    private $productCategoryRepository;

    /**
     * ProductCategoryService constructor.
     * @param ProductCategoryRepository $productCategoryRepository
     */
    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }
}

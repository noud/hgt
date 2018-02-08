<?php

namespace AppBundle\Service;

use AppBundle\Repository\ProductCategoryRepository;

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

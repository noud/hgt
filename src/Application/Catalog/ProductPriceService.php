<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductPriceRepository;

class ProductPriceService
{
    /**
     * @var ProductPriceRepository
     */
    private $priceRepository;

    /**
     * ProductPriceService constructor.
     * @param ProductPriceRepository $priceRepository
     */
    public function __construct(ProductPriceRepository $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }
}

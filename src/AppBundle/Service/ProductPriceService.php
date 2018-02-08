<?php

namespace AppBundle\Service;

use AppBundle\Repository\ProductPriceRepository;

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
<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Product\ProductPictureRepository;

class ProductPictureService
{
    /**
     * @var ProductPictureRepository
     */
    private $productPictureRepository;

    /**
     * ProductPictureService constructor.
     * @param ProductPictureRepository $productPictureRepository
     */
    public function __construct(ProductPictureRepository $productPictureRepository)
    {
        $this->productPictureRepository = $productPictureRepository;
    }
}

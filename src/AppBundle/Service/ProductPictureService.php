<?php

namespace AppBundle\Service;

use AppBundle\Repository\ProductPictureRepository;

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
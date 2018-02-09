<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Cart\CartProductRepository;

class CartProductService
{
    /**
     * @var CartProductRepository
     */
    private $cartProductRepository;

    /**
     * CartProductService constructor.
     * @param CartProductRepository $cartProductRepository
     */
    public function __construct(CartProductRepository $cartProductRepository)
    {
        $this->cartProductRepository = $cartProductRepository;
    }
}

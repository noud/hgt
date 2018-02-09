<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Cart\CartRepository;

class CartService
{
    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * CartService constructor.
     * @param CartRepository $cartRepository
     */
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
}

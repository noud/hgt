<?php

namespace AppBundle\Service;

use AppBundle\Repository\CartRepository;

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
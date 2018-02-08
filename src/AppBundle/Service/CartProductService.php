<?php

namespace AppBundle\Service;

use AppBundle\Repository\CartProductRepository;

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

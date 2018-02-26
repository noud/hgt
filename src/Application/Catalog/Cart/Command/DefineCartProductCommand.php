<?php

namespace HGT\Application\Catalog\Cart\Command;

use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;

class DefineCartProductCommand
{
    /**
     * @var Cart
     */
    public $cart;

    /**
     * DefineCartProductCommand constructor.
     * @param $product
     * @param Cart $cart
     */
    public function __construct($product, Cart $cart)
    {
        $this->product = $product;
        $this->cart = $cart;
    }

    public $form_action;

    /**
     * @var Product
     */
    public $product;

    /**
     * @var ProductUnitOfMeasure
     */
    public $product_unit_of_measure;

    public $qty;
}

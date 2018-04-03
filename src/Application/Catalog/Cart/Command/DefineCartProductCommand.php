<?php

namespace HGT\Application\Catalog\Cart\Command;

use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\Product\ProductUnitOfMeasure;
use HGT\Application\Catalog\Product\UnitOfMeasure;

class DefineCartProductCommand
{
    /**
     * @var Cart
     */
    public $cart;

    /**
     * @var string
     */
    public $form_action;

    /**
     * @var Product
     */
    public $product;

    /**
     * @var ProductUnitOfMeasure
     */
    public $product_unit_of_measure;

    /**
     * @var UnitOfMeasure
     */
    public $unit_of_measure;

    /**
     * @var int
     */
    public $qty;

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
}

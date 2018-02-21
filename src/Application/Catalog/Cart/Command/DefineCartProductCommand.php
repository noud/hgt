<?php

namespace HGT\Application\Catalog\Cart\Command;

class DefineCartProductCommand
{
    /**
     * DefineCartProductCommand constructor.
     * @param $product
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    public $product;

    public $unit_of_measure;

    public $qty;
}

<?php

namespace HGT\Application\Account\Command;

use HGT\Application\User\CustomerProduct\CustomerProduct;

class ReviseOrderListProduct
{
    /**
     * @var IncreaseOrderListProduct[]
     */
    public $products;

    /**
     * @var Cart
     */
    public $cart;

    /**
     * ReviseOrderListProduct constructor.
     * @param $products
     */
    public function __construct($products)
    {
        $this->products = [];

        foreach ($products as  $product) {
            $this->products[] = new IncreaseOrderListProduct($product);
        }
    }
}

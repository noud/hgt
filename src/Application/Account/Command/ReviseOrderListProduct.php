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
     * ReviseOrderListProduct constructor.
     * @param CustomerProduct[]
     */
    public function __construct(array $products)
    {
        $this->products = [];

        foreach ($products as $product) {
            $this->products[] = new IncreaseOrderListProduct($product);
        }
    }
}

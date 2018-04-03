<?php

namespace HGT\Application\Account\Command;

use HGT\Application\User\CustomerProduct\CustomerProduct;

class ReviseOrderListEditProducts
{
    /**
     * @var RemoveOrderlistEditProducts[]
     */
    public $products;

    /**
     * ReviseOrderList constructor.
     * @param array|CustomerProduct[] $products
     */
    public function __construct(array $products)
    {
        $this->products = [];

        foreach ($products as  $product) {
            $this->products[] = new RemoveOrderlistEditProducts($product);
        }
    }
}

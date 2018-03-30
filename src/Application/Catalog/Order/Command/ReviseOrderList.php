<?php

namespace HGT\Application\Catalog\Order\Command;

use HGT\Application\User\CustomerProduct\CustomerProduct;

class ReviseOrderList
{
    /**
     * @var RemoveOrderlistProductItem[]
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
            $this->products[] = new RemoveOrderlistProductItem($product);
        }
    }
}

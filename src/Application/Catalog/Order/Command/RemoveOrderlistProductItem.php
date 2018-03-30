<?php

namespace HGT\Application\Catalog\Order\Command;

use HGT\Application\User\CustomerProduct\CustomerProduct;

class RemoveOrderlistProductItem
{
    /**
     * @var bool
     */
    public $remove;

    /**
     * @var CustomerProduct
     */
    public $product;

    /**
     * RemoveOrderlistProductItem constructor.
     * @param CustomerProduct $product
     */
    public function __construct(CustomerProduct $product)
    {
        $this->remove = false;
        $this->product = $product;
    }
}

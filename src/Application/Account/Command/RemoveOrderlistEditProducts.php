<?php

namespace HGT\Application\Account\Command;

use HGT\Application\User\CustomerProduct\CustomerProduct;

class RemoveOrderlistEditProducts
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

<?php

namespace HGT\Application\Account\Command;

use HGT\Application\User\CustomerProduct\CustomerProduct;

class IncreaseOrderListProduct
{
    /**
     * @var int
     */
    public $increase;

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
        $this->increase = 0;
        $this->product = $product;
    }
}

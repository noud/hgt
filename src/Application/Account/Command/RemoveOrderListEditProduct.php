<?php

namespace HGT\Application\Account\Command;

use HGT\Application\User\CustomerProduct\CustomerProduct;

class RemoveOrderListEditProduct
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
   * RemoveOrderlistEditProducts constructor.
   * @param CustomerProduct $product
   */
    public function __construct(CustomerProduct $product)
    {
        $this->remove = false;
        $this->product = $product;
    }
}

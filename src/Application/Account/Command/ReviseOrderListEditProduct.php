<?php

namespace HGT\Application\Account\Command;

use HGT\Application\User\CustomerProduct\CustomerProduct;

class ReviseOrderListEditProduct
{
  /**
   * @var RemoveOrderListEditProduct[]
   */
    public $products;

  /**
   * ReviseOrderListEditProduct constructor.
   * @param CustomerProduct[]
   */
    public function __construct(array $products)
    {
        $this->products = [];

        foreach ($products as $product) {
            $this->products[] = new RemoveOrderListEditProduct($product);
        }
    }
}

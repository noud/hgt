<?php

namespace HGT\Application\Catalog\Order\Command;

use Symfony\Component\Validator\Constraints as Assert;

class ReviseOrderList
{
    public $products;

    public function __construct($products)
    {
        $this->products = $products;
    }
}

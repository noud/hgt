<?php

namespace HGT\Application\Catalog\Cart\Command;

use HGT\Application\Catalog\Cart\Cart;

class ReviseCartProductCommand
{
    /**
     * ReviseCartProductCommand constructor.
     * @param $products
     * @param Cart $cart
     */
    public function __construct($products, Cart $cart)
    {
        $this->products = $products;
        $this->note = $cart->getNote();
        $this->delivery_date = $cart->getDeliveryDate();
        $this->reference = $cart->getReference();
    }

    public $products;
    public $form_action;
    public $note;
    public $delivery_date;
    public $reference;
}

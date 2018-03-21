<?php

namespace HGT\Application\Catalog\Cart\Command;

use HGT\Application\Catalog\Cart\Cart;
use HGT\AppBundle\Validator\Constraints as HgtAssert;
use Symfony\Component\Validator\Constraints as Assert;

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

    /**
     * @Assert\Range(min = "+ 1 day", minMessage="U heeft een ongeldige datum geselecteerd")
     * @HgtAssert\IsInvalidDeliveryDate()
     * @Assert\NotBlank(groups={"Finish"})
     */
    public $delivery_date;

    public $reference;

    public $client_ip;
}

<?php

namespace HGT\Application\Catalog\Cart\Command;

class MailCartOrderCommand
{
    public $webOrderId;
    public $customerName;
    public $customerCompany;
    public $cartFinishedDate;
    public $cartDeliveryDate;
    public $cartTotalExTax;
    public $cartReference;
    public $customerGroupNavisionId;
    public $cartNote;
    public $cartProducts;
    public $customerCanSeePrices;
}

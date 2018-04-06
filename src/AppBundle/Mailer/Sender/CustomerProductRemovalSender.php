<?php

namespace HGT\AppBundle\Mailer\Sender;

use HGT\Application\User\Customer\Customer;

class CustomerProductRemovalSender
{
    /**
     * @var Mailer
     */
    private $mailer;

    private $mailer_default_to_order_name;
    private $mailer_default_to_order_email;

    /**
     * CustomerProductRemovalSender constructor.
     * @param $mailer_default_to_order_name
     * @param $mailer_default_to_order_email
     * @param Mailer $mailer
     */
    public function __construct(
        $mailer_default_to_order_name,
        $mailer_default_to_order_email,
        Mailer $mailer
    ) {
        $this->mailer_default_to_order_name = $mailer_default_to_order_name;
        $this->mailer_default_to_order_email = $mailer_default_to_order_email;
        $this->mailer = $mailer;
    }

    /**
     * @param $customer
     * @param $products
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendCustomerProductRemoval(Customer $customer, $products)
    {
        $subject = 'Producten verwijderen uit bestellijst';
        $body = $this->mailer->render('emails/customer/customer-product-removal.html.twig', [
            'products' => $products,
            'customer' => $customer
        ]);

        $message = $this->mailer->createMessage($subject, $body, 'text/html');
        $message->addTo($this->mailer_default_to_order_email, $this->mailer_default_to_order_name);
        $this->mailer->send($message);
    }
}

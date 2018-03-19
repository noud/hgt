<?php

namespace HGT\AppBundle\Mailer\Cart;

use HGT\AppBundle\Mailer\Sender\Mailer;
use HGT\Application\Catalog\Order\WebOrder;
use HGT\Application\User\Customer\Customer;

class OrderSender
{
    /**
     * @var Mailer
     */
    private $mailer;

    /**
     * OrderSender constructor.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param WebOrder $webOrder
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendOrderToCustomer(WebOrder $webOrder)
    {
        $subject = 'Uw bestelling WO-1234';
        $body = $this->mailer->render('emails/cart/order.html.twig', [
            'webOrder' => $webOrder
        ]);

        $message = $this->mailer->createMessage($subject, $body, 'text/html');
        //@TODO: Vervangen emailadres met parameters.yml values
        $message->addTo('dennis@webdesigntilburg.nl');

        $this->mailer->send($message);
    }

    /**
     * @param WebOrder $webOrder
     * @param Customer $customer
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendOrdersToSuppliers(WebOrder $webOrder, Customer $customer)
    {
        $supplierProducts = array();
        $cart = $webOrder->getCart();

        foreach ($cart->getCartProducts() as $cartProduct) {
            $product = $cartProduct->getProduct();

            if ($product->getMailOrderToSupplier() !== "" && $product->isOrderProduct() == "1") {
                if (!isset($supplierProducts[$product->getMailOrderToSupplier()])) {
                    $supplierProducts[$product->getMailOrderToSupplier()] = array();
                }
                $supplierProducts[$product->getMailOrderToSupplier()][] = $cartProduct;
            }
        }

        foreach ($supplierProducts as $emailAddress => $cartProducts) {
            // Mail to supplier
            $subject = "Bestelling WO-" . $webOrder->getId() . " van Horeca Groothandel Tilburg B.V.";
            $body = $this->mailer->render('emails/cart/supplier.html.twig', [
                'webOrder' => $webOrder
            ]);

            $message = $this->mailer->createMessage($subject, $body, 'text/html');
            //@TODO: Vervangen emailadres met parameters.yml values
            $message->addTo($emailAddress);

            $this->mailer->send($message);

            // Mail to owner
            $subject = "Kopie van bestelling WO-" . $webOrder->getId() . " aan leverancier " . $emailAddress;
            $body = $this->mailer->render('emails/cart/supplier.html.twig', [
                'is_copy' => true,
                'webOrder' => $webOrder,
            ]);

            $message = $this->mailer->createMessage($subject, $body, 'text/html');

            //@TODO: Vervangen emailadres met parameters.yml values
            $message->addTo('dennis@webdesigntilburg.nl', 'Dennis van den Hout');
            //@TODO: Vervangen emailadres met parameters.yml values
            //$message->addCc('support@webdesigntilburg.nl', 'WebdesignTilburg');

            $this->mailer->send($message);
        }
    }
}

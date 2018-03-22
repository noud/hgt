<?php

namespace HGT\AppBundle\Mailer\Cart;

use Doctrine\Bundle\MigrationsBundle\Command\MigrationsLatestDoctrineCommand;
use HGT\AppBundle\Mailer\Sender\Mailer;
use HGT\Application\Catalog\Cart\Command\MailCartOrderCommand;
use HGT\Application\Catalog\Order\WebOrder;

class OrderSender
{
    /**
     * @var string
     */
    private $mailer;

    private $mailer_default_to_order_cc_name;
    private $mailer_default_to_order_cc_email;
    private $mailer_default_to_order_name;
    private $mailer_default_to_order_email;

    /**
     * OrderSender constructor.
     * @param $mailer_default_to_order_cc_name
     * @param $mailer_default_to_order_cc_email
     * @param $mailer_default_to_order_name
     * @param $mailer_default_to_order_email
     * @param Mailer $mailer
     */
    public function __construct(
        $mailer_default_to_order_cc_name,
        $mailer_default_to_order_cc_email,
        $mailer_default_to_order_name,
        $mailer_default_to_order_email,
        Mailer $mailer
    ) {
        $this->mailer_default_to_order_cc_name = $mailer_default_to_order_cc_name;
        $this->mailer_default_to_order_cc_email = $mailer_default_to_order_cc_email;
        $this->mailer_default_to_order_name = $mailer_default_to_order_name;
        $this->mailer_default_to_order_email = $mailer_default_to_order_email;
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
        $cart = $webOrder->getCart();
        $customer = $cart->getCustomer();

        $data = new MailCartOrderCommand();
        $data->webOrderId = $webOrder->getId();
        $data->customerName = $customer->getName();
        $data->customerCompany = $customer->getCompany();
        $data->cartFinishedDate = $cart->getFinishedDate();
        $data->cartDeliveryDate = $cart->getDeliveryDate();
        $data->cartTotalExTax = $cart->getTotalExTax();
        $data->cartReference = $cart->getReference();

        if ($customer->getCustomerGroup()) {
            $data->customerGroupNavisionId = $customer->getCustomerGroup()->getNavisionId();
        }

        $data->cartNote = $cart->getNote();
        $data->cartProducts = $cart->getCartProducts();
        $data->customerCanSeePrices = $customer->canSeePrices();

        // Mail to customer
        $subject = 'Uw bestelling WO-1234';
        $body = $this->mailer->render('emails/cart/order.html.twig', [
            'data' => $data
        ]);

        $customer = $webOrder->getCart()->getCustomer();
        $message = $this->mailer->createMessage($subject, $body, 'text/html');
        $message->addTo($customer->getEmail(), $customer->getName());
        $this->mailer->send($message);

        // Mail to owner
        $subject = 'Kopie van bestelling WO-' . $webOrder->getId();
        $body = $this->mailer->render('emails/cart/order.html.twig', [
            'is_copy' => true,
            'data' => $data
        ]);

        $message = $this->mailer->createMessage($subject, $body, 'text/html');
        $message->addTo($this->mailer_default_to_order_email, $this->mailer_default_to_order_name);
        $this->mailer->send($message);
    }

    /**
     * @param WebOrder $webOrder
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function sendOrdersToSuppliers(WebOrder $webOrder)
    {
        $supplierProducts = array();
        $cart = $webOrder->getCart();
        $customer = $cart->getCustomer();

        $data = new MailCartOrderCommand();
        $data->webOrderId = $webOrder->getId();
        $data->customerName = $customer->getName();
        $data->customerCompany = $customer->getCompany();
        $data->cartFinishedDate = $cart->getFinishedDate();
        $data->cartDeliveryDate = $cart->getDeliveryDate();
        $data->cartProducts = $cart->getCartProducts();
        $data->cartReference = $cart->getReference();

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
                'data' => $data,
            ]);

            $message = $this->mailer->createMessage($subject, $body, 'text/html');
            $message->addTo($emailAddress);
            $this->mailer->send($message);

            // Mail to owner
            $subject = "Kopie van bestelling WO-" . $webOrder->getId() . " aan leverancier " . $emailAddress;
            $body = $this->mailer->render('emails/cart/supplier.html.twig', [
                'is_copy' => true,
                'data' => $data,
            ]);

            $message = $this->mailer->createMessage($subject, $body, 'text/html');
            $message->addTo($this->mailer_default_to_order_email, $this->mailer_default_to_order_name);
            $message->addCc($this->mailer_default_to_order_cc_email, $this->mailer_default_to_order_cc_name);
            $this->mailer->send($message);
        }
    }
}

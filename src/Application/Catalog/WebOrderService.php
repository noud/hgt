<?php

namespace HGT\Application\Catalog;

use Doctrine\ORM\EntityManagerInterface;
use HGT\AppBundle\Repository\Catalog\Order\WebOrderRepository;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Order\WebOrder;
use HGT\Application\Catalog\Product\UnitOfMeasure;
use HGT\Application\User\CustomerOrderLineService;
use HGT\Application\User\CustomerPriceGroup\CustomerPriceGroup;

class WebOrderService
{
    /**
     * @var WebOrderRepository
     */
    private $webOrderRepository;

    /**
     * @var CustomerOrderLineService
     */
    private $customerOrderLineService;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * WebOrderService constructor.
     * @param WebOrderRepository $webOrderRepository
     */
    public function __construct(
        WebOrderRepository $webOrderRepository,
        CustomerOrderLineService $customerOrderLineService,
        EntityManagerInterface $entityManager
    ) {
        $this->webOrderRepository = $webOrderRepository;
        $this->customerOrderLineService = $customerOrderLineService;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Cart $cart
     * @return WebOrder|null|object
     */
    public function getWeborderByCartId(Cart $cart)
    {
        return $this->webOrderRepository->getByCartId($cart);
    }

    /**
     * @param Cart $cart
     * @return WebOrder
     */
    public function createWebOrder(Cart $cart)
    {
        //@TODO: Export maken van deze order (HGT-201)

        $webOrder = new WebOrder();
        $webOrder->setExportDate(new \DateTime());
        $webOrder->setCart($cart);

        $this->webOrderRepository->add($webOrder);

        return $webOrder;
    }

    /**
     * @param WebOrder $webOrder
     */
    public function exportToNavision(WebOrder $webOrder, $xmlPath)
    {
        if ($webOrder !== null) {
            $webOrder->setExportDate(new \DateTime());
        }

        //to get weborderID
        $this->entityManager->flush();

        $cart = $webOrder->getCart();
        $customer = $cart->getCustomer();
        $cartProducts = $cart->getCartProducts();

        /** @var CustomerPriceGroup $customerPriceGroup */
        $customerPriceGroup = $customer->getCustomerPriceGroup();

        $headString = "<?xml version='1.0' encoding='UTF-8' standalone='yes'?><OrdersData></OrdersData>";

        $rootNode = new \SimpleXMLElement($headString);
        $orders = $rootNode->addChild('Orders');
        $order = $orders->addChild('Order');
        $orderLines = $order->addChild('OrderLines');

        $order->addAttribute('Address', $customer->getAddress1());
        $order->addAttribute('Address2', $customer->getAddress2());
        $order->addAttribute('City', $customer->getCity());
        $order->addAttribute('Company', $customer->getCompany());
        $order->addAttribute('Country', $customer->getCountry());
        $order->addAttribute('CouponId', '');
        $order->addAttribute('CustomerComments', $cart->getNote());
        $order->addAttribute('Email', $customer->getEmail());
        $order->addAttribute('Fax', $customer->getFax());
        $order->addAttribute('FirstName', $customer->getFirstName());
        $order->addAttribute('IPAddress', $cart->getIpAddress());
        $order->addAttribute('LastName', $customer->getLastName());
        $order->addAttribute('CustomerNavisionId', $customer->getNavisionId());
        $order->addAttribute('OrderId', $cart->getId());
        $order->addAttribute('OrderReference', $cart->getReference());
        $order->addAttribute('Phone', $customer->getPhone());
        $order->addAttribute('ShippingCompany', $customer->getShippingCompany());
        $order->addAttribute('PostCode', $customer->getPostCode());
        $order->addAttribute('ShippingAddress1', $customer->getShippingAddress1());
        $order->addAttribute('ShippingAddress2', $customer->getShippingAddress2());
        $order->addAttribute('ShippingCity', $customer->getShippingCity());
        $order->addAttribute('ShippingCountry', $customer->getShippingCountry());
        $order->addAttribute('ShippingEmail', $customer->getShippingEmail());
        $order->addAttribute('ShippingFax', $customer->getShippingFax());
        $order->addAttribute('ShippingFirstName', $customer->getShippingFirstName());
        $order->addAttribute('ShippingLastName', $customer->getShippingLastName());
        $order->addAttribute('ShippingPhone', $customer->getShippingPhone());
        $order->addAttribute('ShippingPostCode', $customer->getShippingPostCode());
        $order->addAttribute('Status', "New");
        $order->addAttribute('WebSiteCustomerId', $customer->getId());
        $order->addAttribute('OrderNumber', 'WO-' . $webOrder->getId());
        $order->addAttribute('PaymentTerms', $customer->getPaymentTerms());
        $order->addAttribute(
            'CustomerPriceGroup',
            $customer->getCustomerPriceGroup() ? $customerPriceGroup->getNavisionId() : '');
        $order->addAttribute('VatBusinessGroup', $customer->getCustomerTaxGroup()->getNavisionId());
        $order->addAttribute(
            'CustomerDiscountGroup',
            $customer->getCustomerGroup() !== null ? $customer->getCustomerDiscountGroup()->getNavisionId() : '');
        $order->addAttribute(
            'InvoiceDiscountGroup',
            $customer->getCustomerGroup() ? $customer->getCustomerGroup()->getNavisionId() : ''
        );
        $order->addAttribute('OrderCost', "0,0000");
        $order->addAttribute('PricingDiscountId', $customer->getNavisionPricingDiscountId());
        $order->addAttribute('PaymentMethod', 'Buy On Account');
        $order->addAttribute('GatewayOrderId', '');
        $order->addAttribute('PaymentErrorCode', '');
        $order->addAttribute('PaymentExtendedErrorCode', "");
        $order->addAttribute('OrderDate', $cart->getFinishedDate()->format('d-m-Y'));
        $order->addAttribute('DeliveryDate', $cart->getDeliveryDate()->format('d-m-Y'));

        $count = 1;

        foreach ($cartProducts as $cartProduct) {
            $product = $cartProduct->getProduct();

            /** @var UnitOfMeasure $unitOfMeasure */
            $unitOfMeasure = $cartProduct->getUnitOfMeasure();
            $orderLine = $orderLines->addChild('orderLine');

            $orderLine->addAttribute('OrderNumber', 'WO-' . $webOrder->getId());
            $orderLine->addAttribute('LineNo', $count++);
            $orderLine->addAttribute('ProductNavisionId', $product->getNavisionId());
            $orderLine->addAttribute('Quantity', $cartProduct->getQty());
            $orderLine->addAttribute('UnitOfMeasureCode', $unitOfMeasure->getNavisionId());
            $orderLine->addAttribute('UnitPrice', $cartProduct->getUnitPrice());
            $orderLine->addChild('actie', $cartProduct->isAction() ? '1' : '0');
        }

        $rootNode->saveXML($xmlPath . '/wo-' . $webOrder->getId() . '.xml');
    }
}

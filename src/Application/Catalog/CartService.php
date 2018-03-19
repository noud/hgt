<?php

namespace HGT\Application\Catalog;

use Doctrine\ORM\EntityManager;
use HGT\AppBundle\Mailer\Cart\OrderSender;
use HGT\AppBundle\Repository\Catalog\Cart\CartRepository;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Cart\CartProduct;
use HGT\Application\Catalog\Cart\Command\ReviseCartProductCommand;
use HGT\Application\User\Customer\Customer;
use HGT\Application\User\CustomerService;

class CartService
{
    /**
     * @var CartRepository
     */
    private $cartRepository;

    /**
     * @var CartProductService
     */
    private $cartProductService;

    /**
     * @var ProductPriceService
     */
    private $productPriceService;

    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var OrderSender
     */
    private $orderSender;

    /**
     * @var WebOrderService
     */
    private $webOrderService;

    /**
     * CartService constructor.
     * @param CartRepository $cartRepository
     * @param CartProductService $cartProductService
     * @param ProductPriceService $productPriceService
     * @param CustomerService $customerService
     * @param EntityManager $entityManager
     * @param OrderSender $orderSender
     * @param WebOrderService $webOrderService
     */
    public function __construct(
        CartRepository $cartRepository,
        CartProductService $cartProductService,
        ProductPriceService $productPriceService,
        CustomerService $customerService,
        EntityManager $entityManager,
        OrderSender $orderSender,
        WebOrderService $webOrderService
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartProductService = $cartProductService;
        $this->productPriceService = $productPriceService;
        $this->customerService = $customerService;
        $this->entityManager = $entityManager;
        $this->orderSender = $orderSender;
        $this->webOrderService = $webOrderService;
    }

    /**
     * @param bool $create_when_not_found
     * @return Cart|null|object
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function getOpenCart($create_when_not_found = false)
    {
        $customer = $this->customerService->getCurrentCustomer();

        $cart = $this->getOpenCartForCustomer($customer);

        if ($cart === null || $create_when_not_found) {
            $cart = $this->createCart();
        }

        return $cart;
    }

    /**
     * @param Cart $cart
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function finish(Cart $cart)
    {
        if ($cart->getState() !== Cart::STATE_FINISHED) {
            $cart->setState(Cart::STATE_FINISHED);
            $cart->setFinishedDate(new \DateTime());
            $cart->setTotalExTax($this->calculateTotalExTax($cart));
            $cart->setTotalIncTax($this->calculateTotalIncTax($cart));
        }

        //create weborder
        $webOrder = $this->webOrderService->getWeborderByCartId($cart);

        if ($webOrder === null) {
            $webOrder = $this->webOrderService->createWebOrder($cart);
        }

        //export weborder to navision
        $this->webOrderService->exportToNavision($webOrder);

        //send emails
        $this->orderSender->sendOrderToCustomer($webOrder);
        $this->orderSender->sendOrdersToSuppliers($webOrder, $cart->getCustomer());

        //
        //@TODO: $this->saveToPreviousCartSession();
    }

    /**
     * @return Cart
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function createCart()
    {
        $cart = new Cart();
        $cart->setCreatedDate(new \DateTime);
        $cart->setState(Cart::STATE_OPEN);
        $cart->setNote('');
        $cart->setCustomer($this->customerService->getCurrentCustomer());
        $cart->setIpAddress('');

        $this->cartRepository->add($cart);

        //@TODO: later misschien er uit halen
        $this->entityManager->flush();

        return $cart;
    }

    /**
     * @param Customer $customer
     * @return Cart|null|object
     */
    public function getOpenCartForCustomer(Customer $customer)
    {
        return $this->cartRepository->getOpenCartForCustomer($customer);
    }

    /**
     * @param Customer $customer
     * @param Cart $cart
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateProductPrices(Customer $customer, Cart $cart)
    {
        $cartProducts = $cart->getCartProducts();

        foreach ($cartProducts as $cartProduct) {
            $product = $cartProduct->getProduct();
            $cartProduct->setUnitPrice(
                $this->productPriceService->getUnitPriceForCustomer(
                    $customer,
                    $product,
                    $cartProduct->getUnitOfMeasure(),
                    $cartProduct->getQty(),
                    $cart->getDeliveryDate()
                )
            );

            $this->cartProductService->updateCartProduct($cartProduct);
        }
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function countProductsInCart()
    {
        $qty = 0;

        $cart = $this->getOpenCart();

        if ($cart !== null) {
            $cartProducts = $cart->getCartProducts();

            /** @var CartProduct $cartProduct */
            foreach ($cartProducts as $cartProduct) {
                $qty += $cartProduct->getQty();
            }
        }

        return $qty;
    }

    /**
     * @param Cart $cart
     * @return array
     */
    public function calculateTotalPerTax(Cart $cart)
    {
        $taxes = array();

        foreach ($cart->getCartProducts() as $cartProduct) {
            if (!isset($taxes[$cartProduct->getTaxPercentage()])) {
                $taxes[$cartProduct->getTaxPercentage()] = 0.0;
            }

            $taxes[$cartProduct->getTaxPercentage()] += $cartProduct->getRowTotal();
        }

        return $taxes;
    }

    /**
     * @param Cart $cart
     * @return int
     */
    public function calculateTotalExTax(Cart $cart)
    {
        $totalExTax = 0;

        foreach ($cart->getCartProducts() as $cartProduct) {
            $totalExTax += $cartProduct->getRowTotal();
        }

        return $totalExTax;
    }

    /**
     * @param Cart $cart
     * @return float|int
     */
    public function calculateTotalIncTax(Cart $cart)
    {
        $totalIncTax = 0;

        foreach ($this->calculateTotalPerTax($cart) as $percentage => $subtotal) {
            $totalIncTax += $subtotal * (1+($percentage/100));
        }

        return $totalIncTax;
    }

    /**
     * @param ReviseCartProductCommand $command
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function reviseCart(ReviseCartProductCommand $command)
    {
        $cart = $this->getOpenCart();

        foreach ($command->products as $cartProductForm) {
            $cartProductItem = $this->cartProductService->getCartProductById($cartProductForm->getId());
            $cartProductItem->setQty($cartProductForm->getQty());
        }

        if ($command->note) {
            $cart->setNote($command->note);
        }

        $cart->setDeliveryDate($command->delivery_date);
        $cart->setReference($command->reference);
        $cart->setIpAddress($_SERVER['REMOTE_ADDR']);

        $this->cartRepository->add($cart);
    }
}

<?php

namespace HGT\Application\Catalog;

use Doctrine\ORM\EntityManager;
use HGT\AppBundle\Repository\Catalog\Cart\CartRepository;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Cart\CartProduct;
use HGT\Application\Catalog\Cart\Command\ReviseCartProductCommand;
use HGT\Application\Catalog\Product\Product;
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
     * CartService constructor.
     * @param CartRepository $cartRepository
     * @param CartProductService $cartProductService
     * @param ProductPriceService $productPriceService
     * @param CustomerService $customerService
     * @param EntityManager $entityManager
     */
    public function __construct(
        CartRepository $cartRepository,
        CartProductService $cartProductService,
        ProductPriceService $productPriceService,
        CustomerService $customerService,
        EntityManager $entityManager
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartProductService = $cartProductService;
        $this->productPriceService = $productPriceService;
        $this->customerService = $customerService;
        $this->entityManager = $entityManager;
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
            /** @var Product $product */
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
     * @return int
     */
    public function calculateTotalExTax(Cart $cart)
    {
        $totalExTax = 0;

        /** @var CartProduct $cartProduct */
        foreach ($cart->getCartProducts($cart) as $cartProduct) {
            $totalExTax += $cartProduct->getRowTotal();
        }

        return $totalExTax;
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

        $cart->setNote($command->note);
        $cart->setDeliveryDate($command->delivery_date);
        $cart->setReference($command->reference);

        $this->cartRepository->add($cart);
    }
}

<?php

namespace HGT\Application\Catalog;

use Doctrine\ORM\EntityManager;
use HGT\AppBundle\Repository\Catalog\Cart\CartRepository;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Cart\CartProduct;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\User\Customer\Customer;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * CartService constructor.
     * @param CartRepository $cartRepository
     * @param CartProductService $cartProductService
     * @param ProductPriceService $productPriceService
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        CartRepository $cartRepository,
        CartProductService $cartProductService,
        ProductPriceService $productPriceService,
        TokenStorageInterface $tokenStorage
    ) {
        $this->cartRepository = $cartRepository;
        $this->cartProductService = $cartProductService;
        $this->productPriceService = $productPriceService;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return Cart
     */
    public function createCart()
    {
        $cart = new Cart();
        $cart->setCreatedDate(new \DateTime);
        $cart->setState(Cart::STATE_OPEN);
        $cart->setNote('');
        $cart->setIpAddress('');

        return $cart;
    }

    /**
     * @param Customer $customer
     * @param Cart $cart
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateProductPrices(Customer $customer, Cart $cart)
    {
        $cartProducts = $this->cartProductService->getCartProducts($cart);

        foreach ($cartProducts as $cartProduct) {

            /** @var Product $product */
            $product = $cartProduct->getProduct();

            $cartProduct->setUnitPrice($this->productPriceService->getUnitPriceForCustomer($customer, $product,
                $cartProduct->getUnitOfMeasure(), $cartProduct->getQty(), $cart->getDeliveryDate()));

            $this->cartProductService->updateCartProduct($cartProduct);
        }
    }

    /**
     * @return int
     */
    public function countProductsInCart()
    {
        $qty = 0;

        $customer = $this->tokenStorage->getToken()->getUser();
        $cart = $this->cartRepository->getOpenCartForCustomer($customer->getId());
        $cartProducts = $this->cartProductService->getCartProducts($cart);

        /** @var CartProduct $cartProduct */
        foreach ($cartProducts as $cartProduct) {
            $qty += $cartProduct->getQty();
        }

        return $qty;
    }

    /**
     * @param Cart $cart
     * @return float|int
     */
    public function calculateTotalExTax(Cart $cart)
    {
        $totalExTax = 0;

        /** @var CartProduct $cartProduct */
        foreach ($this->cartProductService->getCartProducts($cart) as $cartProduct) {
            $totalExTax += $cartProduct->getRowTotal();
        }

        return $totalExTax;
    }
//
//    /**
//     * @param $cart_id
//     * @return float|int
//     */
//    public function calculateTotalIncTax($cart_id)
//    {
//        $totalIncTax = 0;
//
//        foreach ($this->calculateTotalPerTax($cart_id) as $percentage => $subtotal) {
//            $totalIncTax += $subtotal * (1 + ($percentage / 100));
//        }
//
//        return $totalIncTax;
//    }
//
//    /**
//     * @param $cart_id
//     * @return array
//     */
//    /public function calculateTotalPerTax($cart_id)
//    {
//        $taxes = array();
//
//        /** @var CartProduct $cartProduct */
//        foreach ($this->cartProductService->getCartProducts($cart_id) as $cartProduct) {
//            if (!isset($taxes[$cartProduct->getTaxPercentage()])) {
//                $taxes[$cartProduct->getTaxPercentage()] = 0.0;
//            }
//
//            $taxes[$cartProduct->getTaxPercentage()] += $cartProduct->getRowTotal();
//        }
//
//        return $taxes;
//    }
}

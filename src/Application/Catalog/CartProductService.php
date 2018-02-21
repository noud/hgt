<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Cart\CartProductRepository;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Cart\CartProduct;
use HGT\Application\Catalog\Cart\Command\DefineCartProductCommand;

class CartProductService
{
    /**
     * @var CartProductRepository
     */
    private $cartProductRepository;

    /**
     * CartProductService constructor.
     * @param CartProductRepository $cartProductRepository
     */
    public function __construct(CartProductRepository $cartProductRepository)
    {
        $this->cartProductRepository = $cartProductRepository;
    }

    /**
     * @param int $cart_product_id
     * @return CartProduct|object
     */
    public function getCartProductById($cart_product_id) {
        return $this->cartProductRepository->get($cart_product_id);
    }

    /**
     * @param CartProduct $cartProduct
     */
    public function addCartProduct(CartProduct $cartProduct)
    {
        $this->cartProductRepository->add($cartProduct);
    }

    /**
     * @param CartProduct $cartProduct
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function updateCartProduct(CartProduct $cartProduct)
    {
        $this->cartProductRepository->update($cartProduct);
    }

    /**
     * @param CartProduct $cartProduct
     */
    public function removeCartProduct(CartProduct $cartProduct)
    {
        $this->cartProductRepository->remove($cartProduct);
    }

    /**
     * @param DefineCartProductCommand $command
     * @return CartProduct
     */
    public function defineCartProduct(DefineCartProductCommand $command)
    {
        $cartProduct = new CartProduct();

        $cartProduct->setProduct($command->product);
        $cartProduct->setUnitOfMeasure($command->product_unit_of_measure);
        $cartProduct->setQty($command->qty);

        $this->addCartProduct($cartProduct);

        return $cartProduct;
    }

    /**
     * @param Cart $cart
     * @return CartProduct[]
     */
    public function getCartProducts(Cart $cart)
    {
        return $this->cartProductRepository->getCartProductsByCartId($cart->getId());
    }
}

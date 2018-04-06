<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Cart\CartProductRepository;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Cart\CartProduct;
use HGT\Application\Catalog\Cart\Command\DefineCartProductCommand;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\Product\UnitOfMeasure;
use HGT\Application\User\CustomerService;

class CartProductService
{
    /**
     * @var CartProductRepository
     */
    private $cartProductRepository;

    /**
     * @var ProductPriceService
     */
    private $productPriceService;

    /**
     * @var CustomerService
     */
    private $customerService;

    /**
     * CartProductService constructor.
     * @param CartProductRepository $cartProductRepository
     * @param ProductPriceService $productPriceService
     * @param CustomerService $customerService
     */
    public function __construct(
        CartProductRepository $cartProductRepository,
        ProductPriceService $productPriceService,
        CustomerService $customerService
    ) {
        $this->cartProductRepository = $cartProductRepository;
        $this->productPriceService = $productPriceService;
        $this->customerService = $customerService;
    }

    /**
     * @param int $cart_product_id
     * @return CartProduct|object
     */
    public function getCartProductById($cart_product_id)
    {
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
        if ($command->qty <= 0) {
            $qty = 1;
        } else {
            $qty = $command->qty;
        }

        if ($command->unit_of_measure) {
            $unitOfMeasure = $command->unit_of_measure;
        } else {
            $unitOfMeasure = $command->product_unit_of_measure->getUnitOfMeasure();
        }

        $cartProduct = $this->getUniqueCartProduct($command->cart, $command->product, $unitOfMeasure);

        if (is_null($cartProduct)) {
            $cartProduct = new CartProduct();

            $customer = $this->customerService->getCurrentCustomer();

            /** @var Product $product */
            $product = $command->product;

            $taxPercentage = $this->productPriceService->getTaxPercentage(
                $customer->getCustomerTaxGroup(),
                $product->getProductTaxGroup()
            );

            $unitPrice = $this->productPriceService->getUnitPriceForCustomer(
                $customer,
                $product,
                $unitOfMeasure,
                $qty
            );

            $cartProduct->setCart($command->cart);
            $cartProduct->setProduct($product);
            $cartProduct->setUnitOfMeasure($unitOfMeasure);
            $cartProduct->setUnitPrice($unitPrice);
            $cartProduct->setQty($qty);

            $cartProduct->setTaxPercentage($taxPercentage);
            $cartProduct->setIsAction($this->productPriceService->getActionProductPrice(
                $customer,
                $product,
                $unitOfMeasure,
                $qty
            ) ? "1" : "0");

            $this->addCartProduct($cartProduct);
        } else {
            $cartProduct = $this->getCartProductById($cartProduct->getId());
            $cartProduct->setQty($cartProduct->getQty() + $qty);
        }

        return $cartProduct;
    }

    /**
     * @param Cart $cart
     * @param Product $product
     * @param UnitOfMeasure $unit_of_measure
     * @return CartProduct|null|object
     */
    public function getUniqueCartProduct(Cart $cart, Product $product, UnitOfMeasure $unit_of_measure)
    {
        return $this->cartProductRepository->getUniqueCartProduct($cart, $product, $unit_of_measure);
    }
}

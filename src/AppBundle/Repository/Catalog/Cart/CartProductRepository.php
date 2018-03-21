<?php

namespace HGT\AppBundle\Repository\Catalog\Cart;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Cart\CartProduct;
use HGT\Application\Catalog\Product\Product;
use HGT\Application\Catalog\Product\UnitOfMeasure;

class CartProductRepository extends ServiceEntityRepository
{
    /**
     * CartProductRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartProduct::class);
    }

    /**
     * @param int $id
     * @return CartProduct|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param CartProduct $cartProduct
     */
    public function add(CartProduct $cartProduct)
    {
        $this->getEntityManager()->persist($cartProduct);
    }

    /**
     * @param CartProduct $cartProduct
     */
    public function update(CartProduct $cartProduct)
    {
        $this->getEntityManager()->persist($cartProduct);
    }

    /**
     * @param CartProduct $cartProduct
     */
    public function remove(CartProduct $cartProduct)
    {
        $this->getEntityManager()->remove($cartProduct);
    }

    /**
     * @param Cart $cart
     * @return CartProduct[]
     */
    public function getCartProductsByCart(Cart $cart)
    {
        return $this->findBy(compact('cart'));
    }

    /**
     * @param Cart $cart
     * @param Product $product
     * @param UnitOfMeasure $unit_of_measure
     * @return CartProduct|null|object
     */
    public function getUniqueCartProduct(Cart $cart, Product $product, UnitOfMeasure $unit_of_measure)
    {
        return $this->findOneBy(
            [
                'cart' => $cart,
                'product' => $product,
                'unit_of_measure' => $unit_of_measure,
            ]
        );
    }
}

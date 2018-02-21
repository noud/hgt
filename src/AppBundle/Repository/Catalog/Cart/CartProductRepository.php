<?php

namespace HGT\AppBundle\Repository\Catalog\Cart;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Cart\CartProduct;

class CartProductRepository extends EntityRepository
{
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
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(CartProduct $cartProduct)
    {
        $this->getEntityManager()->persist($cartProduct);
        $this->getEntityManager()->flush();
    }

    /**
     * @param CartProduct $cartProduct
     */
    public function remove(CartProduct $cartProduct)
    {
        $this->getEntityManager()->remove($cartProduct);
    }

    /**
     * @param int $cart_id
     * @return CartProduct[]
     */
    public function getCartProductsByCartId($cart_id)
    {
        return $this->findBy([
            'cart' => $cart_id
        ]);
    }
}

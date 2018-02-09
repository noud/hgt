<?php

namespace HGT\AppBundle\Repository\Catalog\Cart;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Cart\CartProduct;

class CartProductRepository extends EntityRepository
{
    /**
     * @param $id
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
    public function remove(CartProduct $cartProduct)
    {
        $this->getEntityManager()->remove($cartProduct);
    }
}

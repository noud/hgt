<?php

namespace AppBundle\Repository;

use AppBundle\Entity\CartProduct;
use Doctrine\ORM\EntityRepository;

class CartProductRepository extends EntityRepository
{
    /**
     * @param $id
     * @return CartProduct
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

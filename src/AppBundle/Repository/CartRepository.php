<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Cart;
use Doctrine\ORM\EntityRepository;

class CartRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Cart
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Cart $cart
     */
    public function add(Cart $cart)
    {
        $this->getEntityManager()->persist($cart);
    }

    /**
     * @param Cart $cart
     */
    public function remove(Cart $cart)
    {
        $this->getEntityManager()->remove($cart);
    }
}
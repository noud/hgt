<?php

namespace HGT\AppBundle\Repository\Catalog\Cart;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Cart\Cart;

class CartRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return Cart|object
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

    /**
     * @param int $customer_id
     * @return null|Cart
     */
    public function getOpenCartForCustomer($customer_id)
    {
        return $this->findOneBy([
            'state' => Cart::STATE_OPEN,
            'customer' => $customer_id
        ]);
    }
}

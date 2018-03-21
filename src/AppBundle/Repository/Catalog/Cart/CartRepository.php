<?php

namespace HGT\AppBundle\Repository\Catalog\Cart;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\User\Customer\Customer;

class CartRepository extends ServiceEntityRepository
{
    /**
     * CartRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

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
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(Cart $cart)
    {
        $this->getEntityManager()->flush($cart);
    }

    /**
     * @param Cart $cart
     */
    public function remove(Cart $cart)
    {
        $this->getEntityManager()->remove($cart);
    }

    /**
     * @param Customer $customer
     * @return Cart|null|object
     */
    public function getOpenCartForCustomer(Customer $customer)
    {
        return $this->findOneBy([
            'state' => Cart::STATE_OPEN,
            'customer' => $customer
        ]);
    }
}

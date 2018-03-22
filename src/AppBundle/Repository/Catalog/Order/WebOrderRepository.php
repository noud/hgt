<?php

namespace HGT\AppBundle\Repository\Catalog\Order;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Order\WebOrder;

class WebOrderRepository extends ServiceEntityRepository
{
    /**
     * WebOrderRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WebOrder::class);
    }

    /**
     * @param $id
     * @return WebOrder|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param WebOrder $webOrder
     */
    public function add(WebOrder $webOrder)
    {
        $this->getEntityManager()->persist($webOrder);
    }

    /**
     * @param WebOrder $webOrder
     */
    public function remove(WebOrder $webOrder)
    {
        $this->getEntityManager()->remove($webOrder);
    }

    /**
     * @param Cart $cart
     * @return WebOrder|null|object
     */
    public function getByCartId(Cart $cart)
    {
        return $this->findOneBy([
            'cart' => $cart
        ]);
    }

    /**
     * @param WebOrder $webOrder
     */
    public function exportToNavision(WebOrder $webOrder)
    {
        $webOrder = $this->get($webOrder);

        if ($webOrder !== null) {
            $webOrder->setExportDate(new \DateTime());
        }
    }
}

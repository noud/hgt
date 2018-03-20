<?php

namespace HGT\Application\Catalog;

use Doctrine\ORM\EntityManager;
use HGT\AppBundle\Repository\Catalog\Order\WebOrderRepository;
use HGT\Application\Catalog\Cart\Cart;
use HGT\Application\Catalog\Order\WebOrder;

class WebOrderService
{
    /**
     * @var WebOrderRepository
     */
    private $webOrderRepository;

    /**
     * WebOrderService constructor.
     * @param WebOrderRepository $webOrderRepository
     */
    public function __construct(WebOrderRepository $webOrderRepository)
    {
        $this->webOrderRepository = $webOrderRepository;
    }

    /**
     * @param Cart $cart
     * @return WebOrder|null|object
     */
    public function getWeborderByCartId(Cart $cart)
    {
        return $this->webOrderRepository->getByCartId($cart);
    }

    /**
     * @param Cart $cart
     * @return WebOrder
     */
    public function createWebOrder(Cart $cart)
    {
        //@TODO: Export maken van deze order (HGT-201)

        $webOrder = new WebOrder();
        $webOrder->setExportDate(new \DateTime());
        $webOrder->setCart($cart);

        $this->webOrderRepository->add($webOrder);

        return $webOrder;
    }

    /**
     * @param WebOrder $webOrder
     */
    public function exportToNavision(WebOrder $webOrder)
    {
        $this->webOrderRepository->exportToNavision($webOrder);
    }
}

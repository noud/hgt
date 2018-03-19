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
     * @var EntityManager
     */
    private $entityManager;

    /**
     * WebOrderService constructor.
     * @param WebOrderRepository $webOrderRepository
     * @param EntityManager $entityManager
     */
    public function __construct(WebOrderRepository $webOrderRepository, EntityManager $entityManager)
    {
        $this->webOrderRepository = $webOrderRepository;
        $this->entityManager = $entityManager;
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
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createWebOrder(Cart $cart)
    {
        //@TODO: Export maken van deze order

        $webOrder = new WebOrder();
        $webOrder->setExportDate(new \DateTime());
        $webOrder->setCart($cart);

        $this->webOrderRepository->add($webOrder);
        $this->entityManager->flush();

        return $webOrder;
    }

    /**
     * @param WebOrder $webOrder
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function exportToNavision(WebOrder $webOrder)
    {
        $this->webOrderRepository->exportToNavision($webOrder);
    }
}

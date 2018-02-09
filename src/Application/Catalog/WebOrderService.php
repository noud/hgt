<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Order\WebOrderRepository;

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
}

<?php

namespace AppBundle\Service;

use AppBundle\Repository\WebOrderRepository;

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

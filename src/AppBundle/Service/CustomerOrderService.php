<?php

namespace AppBundle\Service;

use AppBundle\Repository\CustomerOrderRepository;

class CustomerOrderService
{
    /**
     * @var CustomerOrderRepository
     */
    private $customerOrderRepository;

    /**
     * CustomerOrderService constructor.
     * @param CustomerOrderRepository $customerOrderRepository
     */
    public function __construct(CustomerOrderRepository $customerOrderRepository)
    {
        $this->customerOrderRepository = $customerOrderRepository;
    }
}
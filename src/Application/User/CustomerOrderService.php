<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerOrder\CustomerOrderRepository;

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

<?php

namespace AppBundle\Service;

use AppBundle\Repository\CustomerOrderRepository;

class CustomerPriceGroupService
{
    /**
     * @var CustomerOrderRepository
     */
    private $customerOrderRepository;

    /**
     * CustomerPriceGroupService constructor.
     * @param CustomerOrderRepository $customerOrderRepository
     */
    public function __construct(CustomerOrderRepository $customerOrderRepository)
    {
        $this->customerOrderRepository = $customerOrderRepository;
    }
}
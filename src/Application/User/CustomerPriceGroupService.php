<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerOrder\CustomerOrderRepository;

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

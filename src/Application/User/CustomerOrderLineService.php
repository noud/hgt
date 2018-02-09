<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerOrder\CustomerOrderLineRepository;

class CustomerOrderLineService
{
    /**
     * @var CustomerOrderLineRepository
     */
    private $customerOrderLineRepository;

    /**
     * CustomerOrderLineService constructor.
     * @param CustomerOrderLineRepository $customerOrderLineRepository
     */
    public function __construct(CustomerOrderLineRepository $customerOrderLineRepository)
    {
        $this->customerOrderLineRepository = $customerOrderLineRepository;
    }
}

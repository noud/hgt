<?php

namespace AppBundle\Service;

use AppBundle\Repository\CustomerOrderLineRepository;

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

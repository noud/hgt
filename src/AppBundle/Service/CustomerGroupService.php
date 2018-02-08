<?php

namespace AppBundle\Service;

use AppBundle\Repository\CustomerDiscountGroupRepository;

class CustomerGroupService
{
    /**
     * @var CustomerDiscountGroupRepository
     */
    private $customerDiscountGroupRepository;

    /**
     * CustomerGroupService constructor.
     * @param CustomerDiscountGroupRepository $customerDiscountGroupRepository
     */
    public function __construct(CustomerDiscountGroupRepository $customerDiscountGroupRepository)
    {
        $this->customerDiscountGroupRepository = $customerDiscountGroupRepository;
    }
}
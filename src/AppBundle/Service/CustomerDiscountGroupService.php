<?php

namespace AppBundle\Service;

use AppBundle\Repository\CustomerDiscountGroupRepository;

class CustomerDiscountGroupService
{
    /**
     * @var CustomerDiscountGroupRepository
     */
    private $customerDiscountGroupRepository;

    /**
     * CustomerDiscountGroupService constructor.
     * @param CustomerDiscountGroupRepository $customerDiscountGroupRepository
     */
    public function __construct(CustomerDiscountGroupRepository $customerDiscountGroupRepository)
    {
        $this->customerDiscountGroupRepository = $customerDiscountGroupRepository;
    }
}

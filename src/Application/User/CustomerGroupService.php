<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerDiscountGroup\CustomerDiscountGroupRepository;

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

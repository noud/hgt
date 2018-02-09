<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerDiscountGroup\CustomerDiscountGroupRepository;

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

<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerGroup\CustomerGroupRepository;

class CustomerGroupService
{
    /**
     * @var CustomerGroupRepository
     */
    private $customerGroupRepository;

    /**
     * CustomerGroupService constructor.
     * @param CustomerGroupRepository $customerGroupRepository
     */
    public function __construct(CustomerGroupRepository $customerGroupRepository)
    {
        $this->customerGroupRepository = $customerGroupRepository;
    }
}

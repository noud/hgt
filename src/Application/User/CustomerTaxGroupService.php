<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerTaxGroup\CustomerTaxGroupRepository;

class CustomerTaxGroupService
{
    /**
     * @var CustomerTaxGroupRepository
     */
    private $customerTaxGroupRepository;

    /**
     * CustomerTaxGroupService constructor.
     * @param CustomerTaxGroupRepository $customerTaxGroupRepository
     */
    public function __construct(CustomerTaxGroupRepository $customerTaxGroupRepository)
    {
        $this->customerTaxGroupRepository = $customerTaxGroupRepository;
    }
}

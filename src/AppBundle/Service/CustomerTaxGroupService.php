<?php

namespace AppBundle\Service;

use AppBundle\Repository\CustomerTaxGroupRepository;

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
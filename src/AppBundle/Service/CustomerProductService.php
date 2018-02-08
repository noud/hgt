<?php

namespace AppBundle\Service;

use AppBundle\Repository\CustomerProductRepository;

class CustomerProductService
{
    /**
     * @var CustomerProductRepository
     */
    private $customerProductRepository;

    /**
     * CustomerProductService constructor.
     * @param CustomerProductRepository $customerProductRepository
     */
    public function __construct(CustomerProductRepository $customerProductRepository)
    {
        $this->customerProductRepository = $customerProductRepository;
    }
}
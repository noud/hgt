<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerProduct\CustomerProductRepository;

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

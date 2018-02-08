<?php

namespace AppBundle\Service;

use AppBundle\Entity\Customer;
use AppBundle\Repository\CustomerRepository;

class CustomerService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * CustomerService constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param $username string
     * @return Customer
     */
    public function getCustomerByUsername($username)
    {
        return $this->customerRepository->getByUsername($username);
    }
}

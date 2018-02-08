<?php

namespace AppBundle\Service;

use AppBundle\Entity\Customer;
use AppBundle\Repository\CustomerRepository;
use AppBundle\Security\PasswordEncoder;

class CustomerService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * CustomerService constructor.
     * @param CustomerRepository $customerRepository
     * @param PasswordEncoder $passwordEncoder
     */
    public function __construct(CustomerRepository $customerRepository, PasswordEncoder $passwordEncoder)
    {
        $this->customerRepository = $customerRepository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param $username string
     * @return Customer
     */
    public function getCustomerByUsername($username)
    {
        return $this->customerRepository->getByUsername($username);
    }

    /**
     * @param Customer $customer
     * @param $password
     */
    public function convertOldPassword($customerId, $password)
    {
        $customer = $this->customerRepository->get($customerId);

        if ($customer) {
            $customer->setPassword($this->passwordEncoder->encodePassword($password));
            $customer->setOldPassword(null);
        }

        return $customer;
    }
}

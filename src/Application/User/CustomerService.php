<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\Customer\CustomerRepository;
use HGT\AppBundle\Security\PasswordEncoder;
use HGT\Application\User\PasswordResetHash\Customer;

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
     * @return \HGT\AppBundle\Repository\User\Customer\Customer|object
     */
    public function getCustomerByUsername($username)
    {
        return $this->customerRepository->getByUsername($username);
    }

    /**
     * @param Customer $customer
     * @param $password
     *
     * @return Customer|object
     */
    public function updatePassword($customerId, $password)
    {
        $customer = $this->customerRepository->get($customerId);

        if ($customer) {
            $customer->setPassword($this->passwordEncoder->encodePassword($password));
            $customer->setOldPassword(null);
        }

        return $customer;
    }
}

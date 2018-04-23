<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\Customer\CustomerRepository;
use HGT\AppBundle\Security\PasswordEncoder;
use HGT\Application\User\Customer\Customer;
use HGT\Application\User\CustomerTaxGroup\CustomerTaxGroup;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CustomerService
{
    /**
     * @var string
     */
    private $xmlPath;

    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * CustomerService constructor.
     * @param $xmlPath
     * @param CustomerRepository $customerRepository
     * @param PasswordEncoder $passwordEncoder
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        $xmlPath,
        CustomerRepository $customerRepository,
        PasswordEncoder $passwordEncoder,
        TokenStorageInterface $tokenStorage
    ) {
        $this->customerRepository = $customerRepository;
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenStorage = $tokenStorage;
        $this->xmlPath = $xmlPath;
    }

    /**
     * @param $id
     * @return null|object|Customer
     */
    public function get($id)
    {
        return $this->customerRepository->get($id);
    }

    /**
     * @param $username string
     * @return Customer|object
     */
    public function getCustomerByUsername($username)
    {
        return $this->customerRepository->getByUsername($username);
    }

    /**
     * @return Customer
     */
    public function getCurrentCustomer()
    {
        return $this->tokenStorage->getToken()->getUser();
    }

    /**
     * @return CustomerTaxGroup
     */
    public function getCustomerTaxGroup()
    {
        return $this->getCurrentCustomer()->getCustomerTaxGroup();
    }

    /**
     * @param $customerId
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

    /**
     * @param Customer $customer
     * @return array
     */
    public function getValidDeliveryDays(Customer $customer)
    {
        $delivery_days = array();
        $customerDeliveryDays = $this->customerRepository->getDeliveryDays($customer);

        for ($day = 1; $day <= 6; $day++) {
            if ($customerDeliveryDays == "" || in_array($day, explode(",", $customerDeliveryDays))) {
                $delivery_days[] = $day;
            }
        }

        return $delivery_days;
    }

    public function exportToNavision(Customer $customer)
    {
        $headString = "<?xml version='1.0' encoding='UTF-8' standalone='yes'?><CustomersData></CustomersData>";

        $rootNode = new \SimpleXMLElement($headString);
        $customersNode = $rootNode->addChild('Customers');
        $customerNode = $customersNode->addChild('Customer');

        $customerNode->addAttribute('CustomerId', $customer->getId());
        $customerNode->addAttribute('NavisionId', $customer->getNavisionId());
        $customerNode->addAttribute('UserName', $customer->getUsername());
        $customerNode->addAttribute('FirstName', $customer->getFirstName());
        $customerNode->addAttribute('LastName', $customer->getLastName());
        $customerNode->addAttribute('Company', $customer->getCompany());
        $customerNode->addAttribute('EMail', $customer->getEmail());
        $customerNode->addAttribute('Block', $customer->isBlocked());

        $rootNode->saveXML($this->xmlPath . '/CustomerOut_' . $customer->getId() . '_' . time() . '.xml');
    }
}

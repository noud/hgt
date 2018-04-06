<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerOrder\CustomerOrderRepository;
use HGT\Application\User\Customer\Customer;
use HGT\Application\User\CustomerOrder\CustomerOrder;

class CustomerOrderService
{
    /**
     * @var CustomerOrderRepository
     */
    private $customerOrderRepository;

    /**
     * CustomerOrderService constructor.
     * @param CustomerOrderRepository $customerOrderRepository
     */
    public function __construct(CustomerOrderRepository $customerOrderRepository)
    {
        $this->customerOrderRepository = $customerOrderRepository;
    }

    /**
     * @param Customer $customer
     * @return CustomerOrder[]
     */
    public function getCustomerOrders(Customer $customer, $delivered = false)
    {
        return $this->customerOrderRepository->getCustomerOrders($customer, $delivered);
    }

    /**
     * @param CustomerOrder $customerOrder
     * @return CustomerOrder|object
     */
    public function get(CustomerOrder $customerOrder)
    {
        return $this->customerOrderRepository->get($customerOrder);
    }
}

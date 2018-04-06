<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerOrder\CustomerOrderLineRepository;
use HGT\Application\User\CustomerOrder\CustomerOrder;
use HGT\Application\User\CustomerOrder\CustomerOrderLine;

class CustomerOrderLineService
{
    /**
     * @var CustomerOrderLineRepository
     */
    private $customerOrderLineRepository;

    /**
     * CustomerOrderLineService constructor.
     * @param CustomerOrderLineRepository $customerOrderLineRepository
     */
    public function __construct(CustomerOrderLineRepository $customerOrderLineRepository)
    {
        $this->customerOrderLineRepository = $customerOrderLineRepository;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->customerOrderLineRepository->find($id);
    }

    /**
     * @param CustomerOrder $customerOrder
     * @return CustomerOrderLine[]
     */
    public function getByCustomerOrder(CustomerOrder $customerOrder)
    {
        return $this->customerOrderLineRepository->getByCustomerOrder($customerOrder);
    }
}

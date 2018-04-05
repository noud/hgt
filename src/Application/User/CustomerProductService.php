<?php

namespace HGT\Application\User;

use HGT\AppBundle\Repository\User\CustomerProduct\CustomerProductRepository;
use HGT\Application\User\CustomerGroup\CustomerGroup;

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

    /**
     * @param CustomerGroup $customerGroup
     * @return array
     */
    public function getCustomerProducts($customerGroup)
    {
        return $this->customerProductRepository->getCustomerProducts($customerGroup);
    }

    /**
     * @param $command
     * @return array
     */
    public function getSelectedCustomerProducts($command)
    {
        $countSelected = 0;
        $sendEmail = false;
        $customerProducts = [];

        foreach ($command->products as $removeOrderlistProductItem) {
            if ($removeOrderlistProductItem->remove) {
                $countSelected++;
                $customerProducts[] = $removeOrderlistProductItem->product;
            }
        }

        if ($countSelected > 0) {
            $sendEmail = true;
        }

        return [
            'sendEmail' => $sendEmail,
            'customerProducts' => $customerProducts,
        ];
    }
}

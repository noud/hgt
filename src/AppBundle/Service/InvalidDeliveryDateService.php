<?php

namespace AppBundle\Service;

use AppBundle\Repository\InvalidDeliveryDateRepository;

class InvalidDeliveryDateService
{
    /**
     * @var InvalidDeliveryDateRepository
     */
    private $invalidDeliveryDateRepository;

    /**
     * InvalidDeliveryDateService constructor.
     * @param InvalidDeliveryDateRepository $invalidDeliveryDateRepository
     */
    public function __construct(InvalidDeliveryDateRepository $invalidDeliveryDateRepository)
    {
        $this->invalidDeliveryDateRepository = $invalidDeliveryDateRepository;
    }
}
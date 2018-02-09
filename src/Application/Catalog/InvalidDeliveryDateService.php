<?php

namespace HGT\Application\Catalog;

use HGT\AppBundle\Repository\Catalog\Order\InvalidDeliveryDateRepository;

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

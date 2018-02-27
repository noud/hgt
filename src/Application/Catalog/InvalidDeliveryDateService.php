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

    /**
     * @param \DateTime $date
     * @return bool
     */
    public function isInvalidDeliveryDateByDate(\DateTime $date)
    {
        return count($this->invalidDeliveryDateRepository->getInvalidDeliveryDateByDate($date)) > 0 ? true : false;
    }

    /**
     * @param null $tillDateMysql
     * @return array
     */
    public function getInvalidDeliveryDatesAsDateArray($tillDateMysql = null)
    {
        return $this->invalidDeliveryDateRepository->getInvalidDeliveryDatesAsDateArray($tillDateMysql);
    }

    /**
     * @return array
     */
    public function getValidDeliveryDatesAsDateArray()
    {
        return $this->invalidDeliveryDateRepository->getValidDeliveryDatesAsDateArray();
    }
}

<?php

namespace HGT\AppBundle\Repository\Catalog\Order;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Order\InvalidDeliveryDate;

class InvalidDeliveryDateRepository extends EntityRepository
{
    /**
     * @param $id
     * @return InvalidDeliveryDate|object
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param InvalidDeliveryDate $invalidDeliveryDate
     */
    public function add(InvalidDeliveryDate $invalidDeliveryDate)
    {
        $this->getEntityManager()->persist($invalidDeliveryDate);
    }

    /**
     * @param InvalidDeliveryDate $invalidDeliveryDate
     */
    public function remove(InvalidDeliveryDate $invalidDeliveryDate)
    {
        $this->getEntityManager()->remove($invalidDeliveryDate);
    }
}

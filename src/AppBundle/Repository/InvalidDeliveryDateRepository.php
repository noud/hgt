<?php

namespace AppBundle\Repository;

use AppBundle\Entity\InvalidDeliveryDate;
use Doctrine\ORM\EntityRepository;

class InvalidDeliveryDateRepository extends EntityRepository
{
    /**
     * @param $id
     * @return InvalidDeliveryDate
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
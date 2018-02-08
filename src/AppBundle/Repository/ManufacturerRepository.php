<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Manufacturer;
use Doctrine\ORM\EntityRepository;

class ManufacturerRepository extends EntityRepository
{
    /**
     * @param $id
     * @return Manufacturer
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param Manufacturer $manufacturer
     */
    public function add(Manufacturer $manufacturer)
    {
        $this->getEntityManager()->persist($manufacturer);
    }

    /**
     * @param Manufacturer $manufacturer
     */
    public function remove(Manufacturer $manufacturer)
    {
        $this->getEntityManager()->remove($manufacturer);
    }
}

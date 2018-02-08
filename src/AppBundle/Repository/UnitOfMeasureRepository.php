<?php

namespace AppBundle\Repository;

use AppBundle\Entity\UnitOfMeasure;
use Doctrine\ORM\EntityRepository;

class UnitOfMeasureRepository extends EntityRepository
{
    /**
     * @param $id
     * @return UnitOfMeasure
     */
    public function get($id)
    {
        return $this->find($id);
    }

    /**
     * @param UnitOfMeasure $unitOfMeasure
     */
    public function add(UnitOfMeasure $unitOfMeasure)
    {
        $this->getEntityManager()->persist($unitOfMeasure);
    }

    /**
     * @param UnitOfMeasure $unitOfMeasure
     */
    public function remove(UnitOfMeasure $unitOfMeasure)
    {
        $this->getEntityManager()->remove($unitOfMeasure);
    }
}
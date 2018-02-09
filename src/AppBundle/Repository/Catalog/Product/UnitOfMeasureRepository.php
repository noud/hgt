<?php

namespace HGT\AppBundle\Repository\Catalog\Product;

use Doctrine\ORM\EntityRepository;
use HGT\Application\Catalog\Product\UnitOfMeasure;

class UnitOfMeasureRepository extends EntityRepository
{
    /**
     * @param $id
     * @return UnitOfMeasure|object
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
